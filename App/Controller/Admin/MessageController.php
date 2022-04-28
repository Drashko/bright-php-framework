<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\UserListRepository;
use App\Repository\UserListRepositoryInterface;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class MessageController extends BaseController
{


    public function __construct( ){
        parent::__construct();
        $this->layout = 'admin';
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
     * @throws Exception
     * @throws NotFoundException
     */
    public function indexAction(){
        $this->render('/Admin/message' , []);
    }


}