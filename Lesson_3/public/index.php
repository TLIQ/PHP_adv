<?php

use app\services\Autoload;

include $_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php';

spl_autoload_register(
    [new Autoload(),
        'loadClass']
);


$good = new \app\models\Good();
$good->setPrice(120);
$good->setName('Test');
$good->setInfo('INFO');

$good->save();





