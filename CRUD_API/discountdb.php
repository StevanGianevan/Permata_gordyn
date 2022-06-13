<?php
class DiscountDB{

    // database connection and table name
    public $conn;
    private $table_name = "discount";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>