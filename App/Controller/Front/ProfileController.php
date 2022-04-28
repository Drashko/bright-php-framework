<?php

namespace App\Controller\Front;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class ProfileController extends BaseController
{
    public function __construct(){
        parent::__construct();
    }
    protected function callBeforeMiddlewares() : array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array
    {
        return [];
    }
    /**
     * @throws NotFoundException
     */
    public function indexAction(){
        $this->render('/Front/profile' , []);
    }
}