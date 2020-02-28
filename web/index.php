<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = require __DIR__ . '/../config/web.php';

// debug tools
function d()
{
    foreach (func_get_args() as $val) {
        \yii\helpers\VarDumper::dump($val, 10, true);
    }
}

function dx()
{
    foreach (func_get_args() as $val) {
        d($val);
    }
    exit;
}

function br()
{
    echo '<br><br>';
}


function qx()
{
    foreach (func_get_args() as $val) {
        if (is_object($val) && $val instanceof \yii\db\ActiveQuery) {
            $val = $val->createCommand()->rawSql;
        } elseif (is_object($val) && $val instanceof \yii\db\Command) {
            $val = $val->rawSql;
        }
        echo SqlFormatter::format($val);
    }
    exit;
}

function q()
{
    foreach (func_get_args() as $val) {
        if (is_object($val) && $val instanceof \yii\db\ActiveQuery) {
            $val = $val->createCommand()->rawSql;
        } elseif (is_object($val) && $val instanceof \yii\db\Command) {
            $val = $val->rawSql;
        }
        echo SqlFormatter::format($val);
    }
}

(new yii\web\Application($config))->run();
