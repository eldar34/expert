<?php

return [
    'class' => 'yii\db\Connection',
    // 'dsn' => 'mysql:host=localhost;dbname=test2_expert',
    // 'username' => 'eldar',
    // 'password' => '12345',
    // 'charset' => 'utf8',

    
    // 'dsn' => env('DB_DSN', 'sqlite:/path/to/database/file'),
    'dsn' => 'mysql:host=' . getenv('DB_HOST', '') . ';dbname=' . getenv('DB_NAME', ''),
    'username' => getenv('DB_USERNAME', 'MaG'),
    'password' => getenv('DB_PASSWORD', ''),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
