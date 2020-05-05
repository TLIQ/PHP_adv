<?php


namespace App\repositories;


use App\entities\User;

class UserRepository extends Repository
{
    public function isAuth() : bool
    {
        return isset($_SESSION['login']);
    }
    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityName(): string
    {
        return User::class;
    }

    public function getName()
    {
        return $_SESSION['login'];
    }

//    public function auth($login, $pass)
//    {
//        $user = $this->getWhere('login', $login);
//        if (!$user) {
//            return false;
//        }
//        if (password_verify($pass, $user->pass)) {
//            $_SESSION['login'] = $login;
//            if ($user->is_admin) {
//                $_SESSION['is_admin'] = $user->is_admin;
//            }
//            return true;
//        }
//    }

}