<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers/EnvHelper.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// unset env by $_SERVER
array_map(function($key) {
    unset($_SERVER[$key]);
}, array_keys($_ENV));

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG', true));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'dev'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
