<?php

namespace app\models;

abstract class Model
{
    protected $bd;
    abstract protected function getTableName();
    public function __construct($bd)
    {
        $this->bd = $bd;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->bd->find($sql);
    }


    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName";
        return $this->bd->findAll($sql);
    }
}
