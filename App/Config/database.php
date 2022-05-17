<?php
return [
    'pdo' => [
          'driver' => 'mysql',
          'host' => 'localhost',
          'db_name' => 'mvc_testing',//change it to 'mvc' in production
         // 'db_name' => 'vgrifdrr_brightphp',//change it to 'mvc' in production
         // 'db_user' => 'vgrifdrr_brightphp',//vgrifdrr_brightphp
          'db_user' => 'root',//vgrifdrr_brightphp
          'db_pass' => '',//^{U[f=+C.udO
          //'db_pass' => '^{U[f=+C.udO',//^{U[f=+C.udO
          'charset' => 'utf8',
          'default_fetch' => PDO::FETCH_OBJ
    ]
];
