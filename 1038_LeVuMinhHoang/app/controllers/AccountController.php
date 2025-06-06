<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;
    private $uploadDir = 'uploads/avatars/';

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        
        // Tạo thư mục upload nếu chưa tồn tại
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // Kiểm tra quyền admin
    private function checkAdminAuth() {
        if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
            header('Location: /account/login');
            exit;
        }
    }

    // Kiểm tra đăng nhập
    private function checkAuth() {
        if (!isset($_SESSION['username'])) {
            header('Location: /account/login');
            exit;
        }
    }

    // Xử lý upload avatar
    private function handleAvatarUpload($file, $oldAvatar = null) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Kiểm tra loại file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Chỉ cho phép upload file ảnh (JPG, PNG, GIF)');
        }

        // Kiểm tra kích thước file (2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            throw new Exception('Kích thước file không được vượt quá 2MB');
        }

        // Tạo tên file unique
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $uploadPath = $this->uploadDir . $filename;

        // Upload file
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Xóa avatar cũ nếu có
            if ($oldAvatar && file_exists($oldAvatar)) {
                unlink($oldAvatar);
            }
            return $uploadPath;
        }

        throw new Exception('Có lỗi xảy ra khi upload file');
    }

    public function register() {
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $avatar = null;
            $errors = [];

            try {
                // Validation
                if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
                if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
                if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
                if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
                if (!in_array($role, ['admin', 'user'])) $role = 'user';

                // Validate username format
                if (!empty($username) && !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                    $errors['username'] = "Username chỉ được chứa chữ cái, số và dấu gạch dưới (3-20 ký tự)!";
                }

                // Validate password strength
                if (!empty($password) && strlen($password) < 6) {
                    $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự!";
                }

                // Kiểm tra email format nếu có
                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Email không đúng định dạng!";
                }

                // Validate số điện thoại nếu có
                if (!empty($phone) && !preg_match('/^[0-9+\-\s()]{10,15}$/', $phone)) {
                    $errors['phone'] = "Số điện thoại không đúng định dạng!";
                }

                if ($this->accountModel->getAccountByUsername($username)) {
                    $errors['username'] = "Username này đã được đăng ký!";
                }

                if (!empty($email) && $this->accountModel->getAccountByEmail($email)) {
                    $errors['email'] = "Email này đã được đăng ký!";
                }

                // Xử lý upload avatar
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatar = $this->handleAvatarUpload($_FILES['avatar']);
                }

                if (count($errors) > 0) {
                    include_once 'app/views/account/register.php';
                } else {
                    $result = $this->accountModel->save($username, $fullName, $password, $phone, $email, $avatar, $role);

                    if ($result) {
                        $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                        header('Location: /account/login');
                        exit;
                    } else {
                        $errors['general'] = "Có lỗi xảy ra khi đăng ký!";
                        include_once 'app/views/account/register.php';
                    }
                }
            } catch (Exception $e) {
                $errors['avatar'] = $e->getMessage();
                include_once 'app/views/account/register.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /product');
        exit;
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);

            if ($account && password_verify($password, $account->password)) {
                session_start();
                $_SESSION['username'] = $account->username;
                $_SESSION['fullname'] = $account->fullname;
                $_SESSION['role'] = $account->role;
                $_SESSION['user_id'] = $account->id;
                $_SESSION['avatar'] = $account->avatar;
                
                if ($account->role === 'admin') {
                    header('Location: /account/admin');
                } else {
                    header('Location: /product');
                }
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
    }

    // ========== CHỨC NĂNG ADMIN ==========

    // Xem danh sách người dùng
    public function admin() {
        $this->checkAdminAuth();
        
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $accounts = $this->accountModel->getAllAccounts($limit, $offset);
        $totalAccounts = $this->accountModel->countAccounts();
        $totalPages = ceil($totalAccounts / $limit);
        
        include_once 'app/views/account/admin/list.php';
    }

    // Form thêm người dùng mới
    public function create() {
        $this->checkAdminAuth();
        include_once 'app/views/account/admin/create.php';
    }

    // Xử lý thêm người dùng mới
    public function store() {
        $this->checkAdminAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $avatar = null;
            $errors = [];

            try {
                // Validation
                if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
                if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
                if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
                if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
                if (!in_array($role, ['admin', 'user'])) $role = 'user';

                // Validate username format
                if (!empty($username) && !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                    $errors['username'] = "Username chỉ được chứa chữ cái, số và dấu gạch dưới (3-20 ký tự)!";
                }

                // Validate password strength
                if (!empty($password) && strlen($password) < 6) {
                    $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự!";
                }

                // Validate email nếu có
                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Email không đúng định dạng!";
                }

                // Validate số điện thoại nếu có
                if (!empty($phone) && !preg_match('/^[0-9+\-\s()]{10,15}$/', $phone)) {
                    $errors['phone'] = "Số điện thoại không đúng định dạng!";
                }

                // Kiểm tra trùng lặp
                if ($this->accountModel->getAccountByUsername($username)) {
                    $errors['username'] = "Username này đã tồn tại!";
                }

                if (!empty($email) && $this->accountModel->getAccountByEmail($email)) {
                    $errors['email'] = "Email này đã tồn tại!";
                }

                // Xử lý upload avatar
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatar = $this->handleAvatarUpload($_FILES['avatar']);
                }

                if (count($errors) > 0) {
                    include_once 'app/views/account/admin/create.php';
                } else {
                    $result = $this->accountModel->save($username, $fullName, $password, $phone, $email, $avatar, $role);

                    if ($result) {
                        $_SESSION['message'] = "Thêm người dùng thành công!";
                        header('Location: /account/admin');
                        exit;
                    } else {
                        $errors['general'] = "Có lỗi xảy ra khi thêm người dùng!";
                        include_once 'app/views/account/admin/create.php';
                    }
                }
            } catch (Exception $e) {
                $errors['avatar'] = $e->getMessage();
                include_once 'app/views/account/admin/create.php';
            }
        }
    }

    // Form sửa thông tin người dùng
    public function edit() {
        $this->checkAdminAuth();
        
        $id = $_GET['id'] ?? 0;
        $account = $this->accountModel->getAccountById($id);
        
        if (!$account) {
            $_SESSION['error'] = "Không tìm thấy người dùng!";
            header('Location: /account/admin');
            exit;
        }
        
        include_once 'app/views/account/admin/edit.php';
    }

    // Xử lý cập nhật thông tin người dùng
    public function update() {
        $this->checkAdminAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? 0;
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? null;
            $email = $_POST['email'] ?? null;
            $role = $_POST['role'] ?? 'user';
            $avatar = null;
            $errors = [];

            $account = $this->accountModel->getAccountById($id);
            if (!$account) {
                $_SESSION['error'] = "Không tìm thấy người dùng!";
                header('Location: /account/admin');
                exit;
            }

            try {
                // Validation
                if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
                if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
                if (!in_array($role, ['admin', 'user'])) $role = 'user';

                // Validate username format
                if (!empty($username) && !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                    $errors['username'] = "Username chỉ được chứa chữ cái, số và dấu gạch dưới (3-20 ký tự)!";
                }

                // Validate email nếu có
                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Email không đúng định dạng!";
                }

                // Validate số điện thoại nếu có
                if (!empty($phone) && !preg_match('/^[0-9+\-\s()]{10,15}$/', $phone)) {
                    $errors['phone'] = "Số điện thoại không đúng định dạng!";
                }

                // Kiểm tra trùng lặp username (trừ chính nó)
                $existingUser = $this->accountModel->getAccountByUsername($username);
                if ($existingUser && $existingUser->id != $id) {
                    $errors['username'] = "Username này đã tồn tại!";
                }

                // Kiểm tra trùng lặp email (trừ chính nó)
                if (!empty($email)) {
                    $existingUser = $this->accountModel->getAccountByEmail($email);
                    if ($existingUser && $existingUser->id != $id) {
                        $errors['email'] = "Email này đã tồn tại!";
                    }
                }

                // Xử lý upload avatar mới
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatar = $this->handleAvatarUpload($_FILES['avatar'], $account->avatar);
                }

                if (count($errors) > 0) {
                    include_once 'app/views/account/admin/edit.php';
                } else {
                    $result = $this->accountModel->update($id, $username, $fullName, $phone, $email, $avatar, $role);

                    if ($result) {
                        $_SESSION['message'] = "Cập nhật thông tin thành công!";
                        header('Location: /account/admin');
                        exit;
                    } else {
                        $errors['general'] = "Có lỗi xảy ra khi cập nhật!";
                        include_once 'app/views/account/admin/edit.php';
                    }
                }
            } catch (Exception $e) {
                $errors['avatar'] = $e->getMessage();
                include_once 'app/views/account/admin/edit.php';
            }
        }
    }

    // Xóa người dùng
    public function delete() {
        $this->checkAdminAuth();
        
        $id = $_GET['id'] ?? 0;
        $account = $this->accountModel->getAccountById($id);
        
        if (!$account) {
            $_SESSION['error'] = "Không tìm thấy người dùng!";
            header('Location: /account/admin');
            exit;
        }

        // Không cho phép xóa chính mình
        if ($account->username === $_SESSION['username']) {
            $_SESSION['error'] = "Không thể xóa tài khoản của chính mình!";
            header('Location: /account/admin');
            exit;
        }

        // Xóa avatar nếu có
        if ($account->avatar && file_exists($account->avatar)) {
            unlink($account->avatar);
        }

        $result = $this->accountModel->delete($id);
        
        if ($result) {
            $_SESSION['message'] = "Xóa người dùng thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa người dùng!";
        }
        
        header('Location: /account/admin');
        exit;
    }

    // Đổi mật khẩu người dùng
    public function changePassword() {
        $this->checkAdminAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? 0;
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $errors = [];

            if (empty($newPassword)) $errors['new_password'] = "Vui lòng nhập mật khẩu mới!";
            if ($newPassword != $confirmPassword) $errors['confirm_password'] = "Mật khẩu xác nhận không khớp!";
            if (strlen($newPassword) < 6) $errors['new_password'] = "Mật khẩu phải có ít nhất 6 ký tự!";

            if (count($errors) == 0) {
                $result = $this->accountModel->updatePassword($id, $newPassword);
                
                if ($result) {
                    $_SESSION['message'] = "Đổi mật khẩu thành công!";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi đổi mật khẩu!";
                }
            } else {
                $_SESSION['error'] = implode(', ', $errors);
            }
        }
        
        header('Location: /account/admin');
        exit;
    }

    // Xem chi tiết người dùng
    public function view() {
        $this->checkAdminAuth();
        
        $id = $_GET['id'] ?? 0;
        $account = $this->accountModel->getAccountById($id);
        
        if (!$account) {
            $_SESSION['error'] = "Không tìm thấy người dùng!";
            header('Location: /account/admin');
            exit;
        }
        
        include_once 'app/views/account/admin/view.php';
    }

    // Profile cá nhân
    public function profile() {
        $this->checkAuth();
        
        $username = $_SESSION['username'];
        $account = $this->accountModel->getAccountByUsername($username);
        
        include_once 'app/views/account/profile.php';
    }

    // Cập nhật profile cá nhân
    public function updateProfile() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_SESSION['user_id'];
            $fullName = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? null;
            $email = $_POST['email'] ?? null;
            $avatar = null;
            $errors = [];

            $account = $this->accountModel->getAccountById($id);

            try {
                // Validation
                if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập họ tên!";
                
                // Validate email nếu có
                if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Email không đúng định dạng!";
                }

                // Validate số điện thoại nếu có
                if (!empty($phone) && !preg_match('/^[0-9+\-\s()]{10,15}$/', $phone)) {
                    $errors['phone'] = "Số điện thoại không đúng định dạng!";
                }

                // Kiểm tra trùng lặp email
                if (!empty($email)) {
                    $existingUser = $this->accountModel->getAccountByEmail($email);
                    if ($existingUser && $existingUser->id != $id) {
                        $errors['email'] = "Email này đã được sử dụng!";
                    }
                }

                // Xử lý upload avatar mới
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $avatar = $this->handleAvatarUpload($_FILES['avatar'], $account->avatar);
                }

                if (count($errors) > 0) {
                    include_once 'app/views/account/profile.php';
                } else {
                    $result = $this->accountModel->update($id, null, $fullName, $phone, $email, $avatar);

                    if ($result) {
                        $_SESSION['fullname'] = $fullName;
                        if ($avatar) {
                            $_SESSION['avatar'] = $avatar;
                        }
                        $_SESSION['message'] = "Cập nhật thông tin thành công!";
                    } else {
                        $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật!";
                    }
                    
                    header('Location: /account/profile');
                    exit;
                }
            } catch (Exception $e) {
                $errors['avatar'] = $e->getMessage();
                include_once 'app/views/account/profile.php';
            }
        }
    }

    // Đổi mật khẩu cá nhân
    public function changeMyPassword() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $errors = [];

            $account = $this->accountModel->getAccountById($_SESSION['user_id']);

            if (empty($currentPassword)) $errors['current_password'] = "Vui lòng nhập mật khẩu hiện tại!";
            if (empty($newPassword)) $errors['new_password'] = "Vui lòng nhập mật khẩu mới!";
            if ($newPassword != $confirmPassword) $errors['confirm_password'] = "Mật khẩu xác nhận không khớp!";
            if (strlen($newPassword) < 6) $errors['new_password'] = "Mật khẩu phải có ít nhất 6 ký tự!";

            if (!password_verify($currentPassword, $account->password)) {
                $errors['current_password'] = "Mật khẩu hiện tại không đúng!";
            }

            if (count($errors) == 0) {
                $result = $this->accountModel->updatePassword($_SESSION['user_id'], $newPassword);
                
                if ($result) {
                    $_SESSION['message'] = "Đổi mật khẩu thành công!";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi đổi mật khẩu!";
                }
            } else {
                foreach ($errors as $error) {
                    $_SESSION['error'] = $error;
                    break;
                }
            }
        }
        
        header('Location: /account/profile');
        exit;
    }
}
?>