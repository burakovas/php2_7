<?php
namespace app\services;

use app\traits\TSingleton;

class Db{
    
    private $config = [
       
    ];

    public function __construct($driver, $host, $login, $password, $database, $charset){
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    protected $conn = null;

    protected function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }

    private function query(string $sql, array $params = []){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryObject(string $sql, array $params = [], $class){
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $smtp->fetch();
    }

    public function queryOne(string $sql, array $params = []){
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll(string $sql, array $params = []){
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute(string $sql, array $params = []){
        $this->query($sql, $params);
    }

    public function lastInsertId(){
        return $this->getConnection()->lastInsertId();
    }

    private function prepareDsnString(): string{
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
}
