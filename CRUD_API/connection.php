<?php 
class Database {

    private $host ="localhost";
    private $user ="root";
    private $pass ="";
    private $dbname ="permatagordyn";
    public $conn;
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
// $conn = new mysqli($host, $user, $pass, $dbname);
//    if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

}
