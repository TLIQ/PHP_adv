<?php
namespace App\controllers;

use App\models\User;

class UserController extends Controller
{
    public function oneAction()
    {
        $id = (int)$_GET['id'];
        $user = User::getOne($id);
        return $this->render(
            'good',
            [
                '' => $user,
                'title' => 'Католог товаров',
            ]
        );
    }

    public function allAction()
    {
        $goods = User::getAll();
        return $this->render(
            'goods',
            [
                'goods' => $goods,
                'title' => 'Католог товаров',
            ]
        );
    }

}
