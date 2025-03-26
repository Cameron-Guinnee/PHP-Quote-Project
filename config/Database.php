<?php 
class Database {
    private $host = 'dpg-cvgp732n91rc73a7kk7g-a.oregon-postgres.render.com';
    private $db_name = 'php_quote_project_db';
    private $username;
    private $password;
    private $conn;

    public function __construct() 
    {
        // These are set as environmental variables on render.com 
        $this->username = getenv('USER_NAME');
        $this->password = getenv('PASSWORD');
    }

    public function connect()
    {
        $this->conn = null;

        try 
        {
            $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->db_name . ';user=' . $this->username . ';password=' . $this->password; 
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e) 
        {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
