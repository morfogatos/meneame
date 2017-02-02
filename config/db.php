<?php

$url = getenv('DATABASE_URL');

if ($url !== false) {
    $matches = [];
    preg_match('%postgres://(\w+):(\w+)@([\w\.\-]+):(\d+)/(\w+)%', $url, $matches);
    $host = $matches[3];
    $port = $matches[4];
    $dbname = $matches[5];
    $username = $matches[1];
    $password = $matches[2];

    return [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host=$host;port=$port;dbname=$dbname",
        'username' => $username,
        'password' => $password,
        'charset' => 'utf8',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=meneame',
    'username' => 'meneame',
    'password' => 'meneame',
    'charset' => 'utf8',
];
