<?php
//default folder / namespace is 'Front' folder in App namespace;
return [
    '' => [
        'controller' => 'Home',
        'action' => 'index',
        'namespace' => 'Front'],
    'api' => [
        'controller' => 'Index',
        'action' => 'index',
        'namespace' => 'Api'],

    'admin/{controller}/{action}' => [
        'namespace' => 'Admin'
    ],

    'admin/{controller}/{action}/{id:\d+}' => [
        'namespace' => 'Admin'
    ],
    'ui/{controller}/{action}' => [
        'namespace' => 'Ui'
    ],

    '{controller}/{action}' => [
        'namespace' => 'Front'
    ],
    '{controller}/{action}/{id:\d+}' => [
        'namespace' => 'Front'
    ],
];
