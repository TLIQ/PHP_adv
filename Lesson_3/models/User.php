<?php


namespace app\models;

class User extends Model
{
    public $id;
    public $login;

    protected function getTableName(): string
    {
        return 'users';
    }
}