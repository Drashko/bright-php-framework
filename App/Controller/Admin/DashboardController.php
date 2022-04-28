<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;

class DashboardController extends BaseController {

    public function __construct(){
            parent::__construct();
           $this->layout = 'admin';
    }

    /**
     * Middleware which are executed before any action method is called
     * middlewares are returned within an array as either key/value pair.
     * @return array
     */
    #[ArrayShape(['RequireLoginMiddleware' => "string", 'HasPermissionMiddleware' => "string"])] protected function callBeforeMiddlewares(): array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array{
        return [];
    }

    /**
     * @throws Exception
     */
    public function indexAction(){
       $this->render('/Admin/dashboard', []);
    }


}
