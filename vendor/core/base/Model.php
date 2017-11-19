<?php
/**
 * Created by PhpStorm.
 * User: yelzhas
 * Date: 19.11.2017
 * Time: 19:58
 */

namespace vendor\core\base;

use vendor\core\db;

abstract class Model
{
    protected $pdo;
    protected $table; // table name
    protected $pkey = 'id';

    public function __construct($pkey = 'id')
    {
        $this->pkey=$pkey;
        $this->pdo = Db::instance();
    }

    public function query($sql,$params = [])
    {
        return $this->pdo->execute($sql, $params);
    }

    public function findAll()
    {
        $sql = "select * from {$this->table}";
        return $this->pdo->query($sql);
    }

    public function findOne($value, $field = '', $classname = '')
    {
        $field = $field ? : $this->pkey;
        $sql = "select * from {$this->table} where $field = ? LIMIT 1";

        return $this->pdo->query($sql, [$value], $classname);
    }

    public function findBySql($sql, $params= [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findByLike($str, $field, $table = '')
    {
        $table = $table ? : $this->table;
        $sql = "select * from {$table} where $field like ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }

}
