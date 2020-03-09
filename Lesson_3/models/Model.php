<?php

namespace app\models;

use app\services\Db;

abstract class Model
{
    /**
     * @var Db Класс для работы с базой данных
     */
    protected $db;


    /**
     * Model constructor.
     * @param  $db
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract public function getTableName();

    /**
     * Возращает пользователя с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->find($sql, [':id' => $id]);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} ";
        return $this->db->findAll($sql);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $id]);
    }

    public function save()
    {
        $tableName = $this->getTableName();
        $model = get_object_vars($this);
        unset($model['db']);
        $params = [];
        if(is_null($model['id'])){
            $cols = implode(', ', $this->getAttributes());
            $vals = '';
            foreach ($model as $key => $value) {
                $params[":$key"] = $value;
                $vals .= ":$key, ";
            }
            $valsFormatted = mb_substr($vals, 0, mb_strlen($vals) - 2);
            $sql = "INSERT INTO {$tableName} ($cols) values ({$valsFormatted})";
            return $this->db->execute($sql, $params);
        } else {
            $sql = "UPDATE {$tableName} SET ";
            foreach ($model as $key => $value) {
                if (!is_null($value))
                    $sql .= "{$key}=:{$key}, ";
            }
            $sqlFormatted = mb_substr($sql, 0, mb_strlen($sql) - 2);
            $sqlFormatted .= " WHERE id = :id";
            foreach ($model as $key => $value) {
                if (!is_null($value))
                    $params[":$key"] = $value;
            }
            $this->db->execute($sqlFormatted, $params);
        }
    }

    public function getAttributes()
    {
        $props = [];
        foreach ($this as $key => $value) {
            $props[] = $key;
        }
        unset($props[count($props) - 1]);
        return $props;
    }
}
