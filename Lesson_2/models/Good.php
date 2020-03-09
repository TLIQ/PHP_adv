<?php


namespace app\models;


class Good extends Model
{
    public $id;
    public $name;
    public $info;
    public $price;


    protected function getTableName()
    {
        return 'goods';
    }
}