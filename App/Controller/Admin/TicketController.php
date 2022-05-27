<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class TicketController extends BaseController
{
   public function __construct()
   {
       parent::__construct();
       $this->layout = 'admin';
   }

    protected function callBeforeMiddlewares(): array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    /**
     * @throws NotFoundException
     */
    public function indexAction(){
        $this->render('/Admin/ticket' , []);
    }
}