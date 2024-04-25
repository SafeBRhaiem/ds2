<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'ds2_web';
    private $username = 'root';
    private $password = '';
    public $connexion; 

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
        try {
            $this->connexion = new PDO($dsn, $this->username, $this->password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function fermerConnexion() {
        $this->connexion = null;
    }
     public function query($sql) {
        return $this->connexion->query($sql);
    }
}