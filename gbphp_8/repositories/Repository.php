<?php
namespace App\repositories;

use App\entities\Entity;
use App\main\App;
use App\services\DB;

/**
 * Class Model
 * @property $id
 */
abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;

    abstract protected function getTableName():string;
    abstract protected function getEntityName():string;

    /**
     * Model constructor.
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->findObject(
            $sql,
            $this->getEntityName(),
            [':id' => $id]
        );
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->findObjects($sql, $this->getEntityName());
    }

    public function getWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$field} = :value";
//        var_dump($sql);
//        var_dump($value);
        return $this->db->findObject(
            $sql,
            $this->getEntityName(),
            [":value" => $value]

        );

    }

    public function getAllWhere($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$field} = :value";
//        var_dump($sql);
//        var_dump($value);
        return $this->db->findObjects(
            $sql,
            $this->getEntityName(),
            [":value" => $value]

        );

    }
//    public function getAllWhere($field, $value)
//    {
//        $tableName = $this->getTableName();
//        $sql = "SELECT * FROM {$tableName} WHERE {$field} = :value";
//        return $this->db->findObjects(
//            $sql,
//            [":value" => $value]
//        );
//    }

    public function getAllWhereIn($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$field} IN ({$value})";
        return $this->db->findObjects(
            $sql,
            [":value" => $value]
        );
    }
    protected function getDataForInsert(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $key => $value) {
            if ($key == 'id' || is_null($value)) {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }
        return [
            'columns' => $columns,
            'params' => $params,
        ];
    }
    protected function insert(Entity $entity) : void
    {
        $dataForInsert = $this->getDataForInsert($entity);

        $columns = $dataForInsert['columns'];
        $params = $dataForInsert['params'];

        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ({$columnsString})
          VALUES ({$placeholders})";
        var_dump($sql);
        var_dump($params);
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();

    }

    protected function update(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $key => $value) {
            if ($key === 'db') {
                continue;
            }

            $params[":{$key}"] = $value;
            if ($key == 'id') {
                continue;
            }

            $columns[] = "{$key} = :{$key}";
        }

        $tableName = $this->getTableName();
        $placeholders = implode(',', $columns);

        $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";
        $this->db->execute($sql, $params);
    }

    public function delete(Entity $entity)
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $this->db->execute($sql, [':id' => $entity->id]);
    }





    public function save(Entity $entity) : void
    {
        is_null($entity->id) ? $this->insert($entity) : $this->update($entity);
    }
}
