<?php
include __DIR__ . '/Product.php';

class Products extends BaseEntity {

    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProducts($iid = false) {
        $query = "";
        if ($iid) {
            $query = "select * from product where category_id='{$iid}'";
        } else {
            $query = "SELECT * from product";
        }
        $result = $this->conn->query($query);
        $output = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output [] = new Product($this->conn, $row);
            }
        }
        return $output;
    }

    public function getAuto($keyword) {
        $query = "SELECT * FROM product WHERE name like '%" . $keyword . "%' ORDER BY name LIMIT 0,6";
        $result = $this->conn->query($query);
        $output = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output [] = new Product($this->conn, $row);
            }
        }
        return $output;
    
    }

}
