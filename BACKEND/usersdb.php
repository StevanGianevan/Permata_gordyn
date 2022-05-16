<?php
class UsersDb{

    // database connection and table name
    public $conn;
    private $table_name = "users";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
?>