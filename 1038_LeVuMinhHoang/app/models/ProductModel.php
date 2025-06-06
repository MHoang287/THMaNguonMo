<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts($options = [])
    {
        // Base query
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, p.category_id, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id";
        
        $whereConditions = [];
        $params = [];
        
        // Search functionality
        if (!empty($options['search'])) {
            $whereConditions[] = "(p.name LIKE :search OR p.description LIKE :search)";
            $params['search'] = '%' . $options['search'] . '%';
        }
        
        // Category filter
        if (!empty($options['category_id'])) {
            $whereConditions[] = "p.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        // Price range filter
        if (!empty($options['min_price'])) {
            $whereConditions[] = "p.price >= :min_price";
            $params['min_price'] = $options['min_price'];
        }
        
        if (!empty($options['max_price'])) {
            $whereConditions[] = "p.price <= :max_price";
            $params['max_price'] = $options['max_price'];
        }
        
        // Add WHERE clause if conditions exist
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        // Sorting
        $sortBy = $options['sort'] ?? 'id';
        $sortOrder = $options['order'] ?? 'DESC';
        
        switch ($sortBy) {
            case 'name':
                $query .= " ORDER BY p.name " . $sortOrder;
                break;
            case 'price_asc':
                $query .= " ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $query .= " ORDER BY p.price DESC";
                break;
            case 'category':
                $query .= " ORDER BY c.name " . $sortOrder . ", p.name ASC";
                break;
            case 'newest':
                $query .= " ORDER BY p.id DESC";
                break;
            case 'oldest':
                $query .= " ORDER BY p.id ASC";
                break;
            default:
                $query .= " ORDER BY p.id DESC";
                break;
        }
        
        // Pagination
        if (!empty($options['limit'])) {
            $offset = $options['offset'] ?? 0;
            $query .= " LIMIT :limit OFFSET :offset";
            $params['limit'] = $options['limit'];
            $params['offset'] = $offset;
        }
        
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            if ($key === 'limit' || $key === 'offset') {
                $stmt->bindValue(':' . $key, (int)$value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTotalProducts($options = [])
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id";
        
        $whereConditions = [];
        $params = [];
        
        // Search functionality
        if (!empty($options['search'])) {
            $whereConditions[] = "(p.name LIKE :search OR p.description LIKE :search)";
            $params['search'] = '%' . $options['search'] . '%';
        }
        
        // Category filter
        if (!empty($options['category_id'])) {
            $whereConditions[] = "p.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        // Price range filter
        if (!empty($options['min_price'])) {
            $whereConditions[] = "p.price >= :min_price";
            $params['min_price'] = $options['min_price'];
        }
        
        if (!empty($options['max_price'])) {
            $whereConditions[] = "p.price <= :max_price";
            $params['max_price'] = $options['max_price'];
        }
        
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }

    public function getFeaturedProducts($limit = 8)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                ORDER BY p.id DESC LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductsByCategory($categoryId, $limit = null)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.category_id = :category_id
                ORDER BY p.id DESC";
        
        if ($limit) {
            $query .= " LIMIT :limit";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        
        if ($limit) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPriceRange()
    {
        $query = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addProduct($name, $description, $price, $category_id, $image)
    {
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }

        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }

        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        $image = htmlspecialchars(strip_tags($image));
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $image)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id, image=:image WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        $image = htmlspecialchars(strip_tags($image));
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return true;
        }
            return false;
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}