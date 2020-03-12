<?php

namespace app\services;
use app\traits\TSingleton;
use PDO;

class Db
{
    use TSingleton;

    private $config = [
        'user' => 'user1',
        'pass' => '123',
        'driver' => 'mysql',
        'bd' => 'gbphp',
        'host' => 'localhost',
        'charset' => 'UTF8',
    ];

    /**
     * @var PDO|null
     */
    protected $connect = null;

    /**
     * Возвращает только один коннект с базой - объект PDO
     * @return PDO|null
     */
    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new PDO(
                $this->getDSN(),
                $this->config['user'],
                $this->config['pass']
            );
            $this->connect->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ
            );
        }
        return $this->connect;
    }

    /**
     * Создание строки - настройки для подключения
     * @return string
     */
    private function getDSN()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['bd'],
            $this->config['charset']
        );
    }


    private function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }


    public function find(string $sql, array $params = [])
    {

        return $this->query($sql, $params)->fetch() ;
    }

    public function findAll(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }
}