<?php
class Cart3Db{

    // database connection and table name
    public $conn;
    private $table_name = "cart3";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>