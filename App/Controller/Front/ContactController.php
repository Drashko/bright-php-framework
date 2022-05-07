<?php

namespace App\Controller\Front;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class ContactController extends BaseController
{

    #[ArrayShape(['RequireLoginMiddleware' => "string", 'HasPermissionMiddleware' => "string"])] protected function callBeforeMiddlewares() : array
    {
        return [];
    }

    protected function callAfterMiddlewares() : array
    {
        return [];
    }
    /**
     * @throws NotFoundException
     */
    public function indexAction(){
        $this->render('/Front/contact' , []);
    }
}