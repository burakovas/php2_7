<?php
$config = include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";

\app\base\App::call()->run($config);


    //это самодельный автоловадер, можно использовать если убрать композер
    //include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";
    //spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);
