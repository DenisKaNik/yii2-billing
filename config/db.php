<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.env('DB_HOST', 'localhost').';port='.env('DB_PORT', '3306').';dbname='.env('DB_NAME'),
    'username' => env('DB_USR'),
    'password' => env('DB_PWD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
