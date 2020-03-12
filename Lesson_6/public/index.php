<?php
use App\services\renders\TwigRenderer;
use \App\services\Request;

include dirname(__DIR__) . "/vendor/autoload.php";

try {
    $request = new Request();
} catch (\Exception $exception) {
    var_dump($exception);
}



$controllerName = $request->getControllerName();
if (empty($controllerName)) {
    $controllerName = 'good';
}

$actionName = $request->getActionName();
if (empty($actionName)) {
    $actionName = '';
}

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /** @var App\controllers\Controller $controller */
    $controller = new $controllerClass(
        new TwigRenderer(),
        $request
    );
    echo $controller->run($actionName);
}



