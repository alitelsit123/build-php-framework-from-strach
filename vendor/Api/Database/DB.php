<?php
namespace Api\Database;

class DB
{
    use Connection;
    private static $db;
    private $result, $count, $error = true;
    public function __construct()
    {
        $this->connector();
    }
    /**
     * @return Void
     * Default SQL
     */
    public static function select($sql, $value = null)
    {
        try
        {
            if($value !== null)
            {} 
            else 
            {
                $statment = self::getInstance()->getConnection()->prepare($sql);
            }
            if($statment->execute())
            {        
                self::getInstance()->result = $statment->fetchAll(\PDO::FETCH_OBJ);
                self::getInstance()->count = $statment->rowCount();
                return self::getInstance();            
            }
            else 
            {
                echo 'Query Error: ';    
                return self::getInstance();
            }
        }
        catch(\PDOException $e)
        {}
    }
    public static function insert($sql, $value = null)
    {
        try
        {
            if($value !== null)
            {
                $valuebeforebind = self::getInstance()->arrayfromColon($sql);
                $sql = self::getInstance()->removeBrackets($sql, $valuebeforebind);
                $statment = self::getInstance()->getConnection()->prepare($sql);
                for($index = 0;$index < sizeof($valuebeforebind); $index++)
                {
                    // echo $valuebeforebind[$index] . ', ' . $value[$index] . '<br/>';
                    $statment->bindParam($valuebeforebind[$index], $value[$index]);
                }
            }
            else 
            {
                $statment = self::getInstance()->getConnection()->prepare($sql);            
            } 
            if(self::getInstance()->result = $statment->execute())
            {
                return self::getInstance();
            }
            else 
            {
                echo 'Query Error: ';    
                return self::getInstance();
            }
        }
        catch(\PDOException $e)
        {}
    }
    public static function update($sql, $value = null)
    {
        try{
            if($value !== null)
            {} 
            else 
            {
                $statment = self::getInstance()->getConnection()->prepare($sql);
            }
            if(self::getInstance()->result = $statment->execute())
            {
                return self::getInstance();            
            }
            else 
            {
                echo 'Query Error: ';    
                return self::getInstance();
            }
        }
        catch(\PDOException $e)
        {}
    }
    public static function delete($sql, $value = null)
    {
        try{
            if($value !== null)
            {} 
            else 
            {
                $statment = self::getInstance()->getConnection()->prepare($sql);
            }
            if(self::getInstance()->result = $statment->execute())
            {
                return self::getInstance();            
            }
            else 
            {
                echo 'Query Error: ';    
                return self::getInstance();
            }
        }
        catch(\PDOException $e)
        {}
    }
    public function rowCount()
    {
        return self::getInstance()->count;
    }
    public function getResult()
    {
        return self::getInstance()->result;
    }
    /**
     * Get Array from Brackets '[]' $sql
     * return @var Array
     */
    public function arrayfromColon($sql)
    {
        // echo $sql;
        preg_match_all('/\[(.*?)\]/', $sql, $valuematch);
        foreach($valuematch[0] as $key => $value)
        {
            $valuematch[$key] = str_replace('[', ':', str_replace(']', '', $value));
        }
        return $valuematch;
    }
    /**
     * remove trailling Brackets '[]'
     */
    public function removeBrackets($sql, $mask)
    {
        foreach($mask as $v)
        {
            $sql = str_replace('[', ':', str_replace(']', '', $sql));
        }
        return $sql;
    }
    /**
     * 
     */
    public static function getInstance()
    {
        if(self::$db === null)
            self::$db = new DB();
        return self::$db;
    }
}