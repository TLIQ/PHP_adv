<?php


namespace App\controllers;


use App\repositories\GoodRepository;
use App\services\BasketService;
use App\services\renders\IRenderer;
use App\services\Request;

class BasketController extends Controller
{
    protected $goodRepository;
    protected $basketService;

    public function __construct(IRenderer $renderer, Request $request)
    {
        $this->goodRepository = new GoodRepository();
        $this->basketService = new BasketService($request);
        parent::__construct($renderer, $request);
    }

    public function indexAction()
    {
        return $this->render(
            'basket',
            [
                'goods' => $this->basketService->getBasket()
            ]
        );
    }

    public function addAction()
    {
        $id = $this->getId();
        $msg = $this->basketService->add($id, $this->goodRepository);
        $this->request->addMsg($msg);
        $this->redirectApp();
    }
}