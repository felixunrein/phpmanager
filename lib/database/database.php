<?php

class database {
    private $user;
    private $password;
    private $databaseName;
    private $host;
    private $config;

    public $PDO_Database;

     public function __construct()
    {
        $this->config = parse_ini_file(ROOT_PATH . "/config/config.ini", true);
        $this->user = $this->config['database']['user'];
        $this->password = $this->config['database']['password'];
        $this->host = $this->config['database']['host'];
        $this->databaseName = $this->config['database']['db-1'];
        $this->connect();

    }

    private function connect() {
        try {
            $this->PDO_Database = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->databaseName, $this->user, $this->password);
        } catch (PDOException $e) {
            print $e;
        }
     }



/////////////Query/////////////
    public function demoQuery($var) {
        $query = "select * from `table` where `var`=:var";
        $stmt = $this->PDO_Database->prepare($query);
        $stmt->bindParam('var', $var, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}

