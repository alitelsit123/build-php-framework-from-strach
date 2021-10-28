<?php
namespace Api\Database;

class QueryBuilder implements QuerySelect, QueryInsert, QueryUpdate, QueryDelete
{
    private $table;
    private $sql;
    public static function table($tableName){}
    public function get(){}
    public function insert(){}
    public function update(){}
    public function delete(){}
}