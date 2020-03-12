<?php

namespace App\controllers;


use App\services\renders\IRenderer;
use App\services\Request;

abstract class Controller
{
    const SESSION_NAME_GOODS = 'good';
    protected $defaultAction = 'index';
    protected $renderer;
    protected $request;

    public function __construct(IRenderer $renderer, Request $request)
    {
        $this->renderer = $renderer;
        $this->request = $request;
    }

    public function run($actionName)
    {
        if (empty($actionName)) {
            $actionName = $this->defaultAction;
        }
        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            return $this->$actionName();
        }
        return '404';
    }

    protected function getId()
    {
        return (int)$this->request->get('id');
    }

    protected function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    public function redirectApp($path = ''){
        return $this->request->redirect($path);
    }
}
