<?php

/**
 * @method User setName(String $username);
 */
include __DIR__ . '/BaseEntity.php';

class Product extends BaseEntity {

    public $id;
    public $name;
    public $description;
    public $categoryId;
    public $price;
    public $photo;
    public $userId;
    public $createdAt;
    public $conn;

    public function __construct($conn, $row = false) {
        $this->conn = $conn;
        if ($row) {
            $this->conn = $conn;
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->categoryId = $row['category_id'];
            $this->price = $row['price'];
            $this->photo = $row['photo'];
            $this->userId = $row['user_id'];
        }
    }

    public function getProduct($id) {
        $query = "SELECT * from product where id='{$id}'";
        $result = $this->conn->query($query);
        $obj = $result->fetch_assoc();
        $row = new Product($this->conn, $obj);
        return $row;
    }

    public function save() {
        $time = time();
        $query = "INSERT INTO `ecommerce`.`product` (`id`, `name`, `description`,`category_id`, `price`, `photo` ,  `created_at`) VALUES (NULL, '{$this->getName()}', '{$this->getDescription()}', '{$this->getCategoryId()}', '{$this->getPrice()}', '{$this->getPhoto()}',  NOW());";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $this->id = mysqli_insert_id($this->conn);
        return $this->id;
    }

    public function update() {
        $query = "UPDATE `ecommerce`.`product` SET `name`='{$this->getName()}', `description`='{$this->getDescription()}', `photo`='{$this->getPhoto()}', `category_id`='{$this->getCategoryId()}', `price`='{$this->getPrice()}' WHERE `id`='{$this->getId()}'";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }
      public function delete($id) {
        $query ="DELETE FROM `ecommerce`.`product` WHERE `id`='{$id}'";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }

}
