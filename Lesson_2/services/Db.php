<?php

namespace app\services;
class Db
{

    public function find($sql)
    {
        return 'find ' . $sql;
    }

    public function findAll($sql)
    {
        return 'findAll ' . $sql;
    }
}