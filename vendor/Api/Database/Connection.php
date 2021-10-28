<?php
namespace Api\Database;
use Api\Config\Config;

trait Connection
{
    protected $pdo;
    protected $server_name;
    protected $username;
    protected $password;
    protected $db_name;
    protected function connector()
    {
        $this->server_name = Config::get('database/server_name');
        $this->db_name = Config::get('database/db_name');
        $this->username = Config::get('database/username');
        $this->password = Config::get('database/password');
        try{
            // var_dump(Config::get('database/server_name'));
            $this->pdo = new \PDO(
                'mysql:host='.$this->server_name.';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            // echo 'mysql:host='.$this->server_name.';dbname=' . $this->db_name . ' Username: ' .
            $this->username . ' Password: ' .
            $this->password;
            // echo '<br/>';
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // var_dump($this->pdo);
        }
        catch(\PDOException $e)
        {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }
    public function getConnection()
    {
        return $this->pdo;
    }
}