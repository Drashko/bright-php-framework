<?php
return [
    'pdo' => [
          'driver' => 'mysql',
          'host' => 'localhost',
          'db_name' => '',//change it to 'mvc' in production
          'db_user' => '',//
          'db_pass' => '',
          'charset' => 'utf8',
          'default_fetch' => PDO::FETCH_OBJ
    ]
];
