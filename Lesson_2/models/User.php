<?php


namespace app\models;


class User extends Model
{
    public $id;
    public $name;
    public $login;
    public $password;
    public $isAdmin;

    protected function getTableName()
    {
        return 'users';
    }
}