<?php

/**
 * @method User setUsername(String $username);
 */
include __DIR__ .'/BaseEntity.php';

class User extends BaseEntity {

    public $id;
    public $username;
    public $name;
    public $password;
    public $phone;
    public $email;
    public $photo;
    public $createdAt;
    public $conn;

    public function __construct($conn, $userId = false) {
        $this->conn = $conn;
        if ($userId) {
            $query = "SELECT * FROM user Where id={$userId}";
            $result = $this->conn->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                foreach ($row as $key =>$value){
                    $this->$key = $value;
                }
                }
                  
        }else{
            
            echo '0 Result';
        }
    }
    
    public function save() {
        $time = time();
        $query = "INSERT INTO `ecommerce`.`user` (`id`, `username`, `name`, `password`, `phone`, `email`, `photo`, `created_at`) VALUES (NULL, '{$this->getUsername()}', '{$this->getName()}', '{$this->getPassword()}', '{$this->getPhone()}', '{$this->getEmail()}', '{$this->getPhoto()}', NOW());";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $this->id = mysqli_insert_id($this->conn);
        return $this->id;
    }
    public function update(){
      $query = "UPDATE `ecommerce`.`user` SET `username`='{$this->getUsername()}', `name`='{$this->getName()}' , `photo`='{$this->getPhoto()}', `phone`='{$this->getPhone()}', `email`='{$this->getEmail()}' WHERE `id`='{$this->getId()}'";
      mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        
    }

}
