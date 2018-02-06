<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

 class Rate extends BaseEntity {
    
    public $id;
    public $pid;
    public $rates;
    public $conn;

    public function __construct($conn, $row = false) {
        $this->conn = $conn;
        if ($row) {
            $this->conn = $conn;
            $this->id = $row['id'];
            $this->pid = $row['pid'];
            $this->rates = $row['rate'];
        }
    }


    public function getRate($id) {
        $query = "select * from rating where pid='$id'";
        $result = $this->conn->query($query);      
        $output = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $output [] = new Rate($this->conn, $row);
            }
        }
        return $output;
  }

    public function save($pid ,$php_rating) {
        $time = time();
        $query = "INSERT INTO `ecommerce`.`rating` (`id`, `pid`, `rate`) VALUES ('0', '$pid', '$php_rating');
";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $this->id = mysqli_insert_id($this->conn);
        return $this->id;
    }
}
