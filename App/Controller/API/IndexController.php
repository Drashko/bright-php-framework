<?php

namespace App\Controller\API;

use src\Base\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction(){
        echo 'Api';
    }
}