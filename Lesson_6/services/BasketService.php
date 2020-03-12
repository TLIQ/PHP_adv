<?php


namespace App\services;


use App\controllers\Controller;
use App\repositories\GoodRepository;

class BasketService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getBasket()
    {
        $goods = $this->request->getSession(Controller::SESSION_NAME_GOODS);
        if (empty($goods)){
            $goods = [];
        }
        return $goods;
    }

    public function add($id, GoodRepository $goodRepository){

        if (empty($id)){
            return 'Не передан id товара';
        }
        $good = $goodRepository->getOne($id);

        if (empty($good)){
            return 'Товар не найден';
        }

        $goods = $this->request->getSession(Controller::SESSION_NAME_GOODS);
        if (is_array($goods) && array_key_exists($id, $goods)){
            $goods[$id]['count']++;
        }else{
            $goods[$id] = [
                'name' => $good->getName(),
                'price' => $good->getPrice(),
                'count' => 1,
            ];
        }

        $this->request->setSession(Controller::SESSION_NAME_GOODS, $goods);
        return 'Товар добавлен';
    }
}