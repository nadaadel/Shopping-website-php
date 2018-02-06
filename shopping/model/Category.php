<?php


//include __DIR__ .'/Product.php';

class Category extends BaseEntity{
    public $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getId($cat){
        
      $query = "SELECT * from category where name='{$cat}'";
      $result = $this->conn->query($query);
           $row = $result->fetch_assoc();
        return $row['id'];
    } 
    
}



