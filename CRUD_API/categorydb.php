<?php
class CategoryDb{

    // database connection and table name
    public $conn;
    private $table_name = "category";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>