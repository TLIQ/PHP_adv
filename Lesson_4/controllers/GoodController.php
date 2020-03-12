<?php
namespace App\controllers;

use App\models\Good;

class GoodController extends Controller
{
    public function indexAction()
    {
        return $this->render('home');
    }

    public function oneAction()
    {
        $id = (int)$_GET['id'];
        $good = Good::getOne($id);
        return $this->render(
            'good',
            [
                'good' => $good,
                'title' => 'Католог товаров',
            ]
        );
    }

    public function allAction()
    {
        $goods = Good::getAll();
        return $this->render(
            'goods',
            [
                'goods' => $goods,
                'title' => 'Католог товаров',
            ]
        );
    }
    public function addAction()
    {
        $good = new Good();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $good->setName($_POST['name']);
            $good->setInfo($_POST['info']);
            $good->setPrice($_POST['price']);
            $good -> save();
            header('location: /?c=good&a=all');
            return '';
        }
        return $this->render('formGood',
        ['action' => '?c=good&a=add', 'good' => $good]
        );
    }
    public function updateAction()
    {
        $id = $_GET['id'];
        $good = Good::getOne($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $good->setName($_POST['name']);
            $good->setInfo($_POST['info']);
            $good->setPrice($_POST['price']);
            $good -> save();
            header('location: /?c=good&a=all');
            return '';
        }
        return $this->render('formGood',
            ['action' => "?c=good&a=update&id={$id}", 'good' => $good]
        );
    }
    public function ajaxAction()
    {
        header('Content-type: application/json');
        $params = [
            'error' => 'asdasd',
        ];
        return json_encode($params);
    }


}
