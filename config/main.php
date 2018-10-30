<?php
return[
  "rootDir" => __DIR__ . "/../",
  'templatesDir' => __DIR__ . "/../views/",
  'defaultController' => 'product',
  'controllerNamespace' => "app\\controllers",
  'components' => [
    'db' => [
      'class' => \app\services\DB::class,
      'driver' => 'mysql',
      'host' => '185.80.130.82',
      'login' => 'php1user',
      'password' => 'php1user',
      'database' => 'php1L7',
      'charset' => 'utf8'
    ],
    'request' => [
      'class' => \app\services\Request::class
    ],
    'renderer' => [
      'class' => \app\services\renderers\TemplateRenderer::class
    ]
  ]
];
