<?php
    define('YII_DEBUG', true);
    require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
    ini_set('diplay_errors',true);
    $config = require(__DIR__ . '/../config/web.php');
    (new yii\web\Application($config))->run();