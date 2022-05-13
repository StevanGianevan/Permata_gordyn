<?php
class ProductDb{

    // database connection and table name
    public $conn;
    private $table_name = "product";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>