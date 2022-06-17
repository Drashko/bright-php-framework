<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Git\GitRepositoryInterface;
use App\Service\Git\GitCreateServiceInterface;
use App\Service\Git\GitUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Utility\Route;

class GitController extends BaseController
{

    private GitRepositoryInterface $gitRepository;

    private GitCreateServiceInterface $gitCreateService;

    private GitUpdateServiceInterface $gitUpdateService;

    public function __construct(GitRepositoryInterface $gitRepository, GitCreateServiceInterface $gitCreateService, GitUpdateServiceInterface $gitUpdateService){
        parent::__construct();
        $this->gitRepository = $gitRepository;
        $this->gitCreateService = $gitCreateService;
        $this->gitUpdateService = $gitUpdateService;
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
        $conditions = Route::getUrlParam();
        $data['gitList'] = $this->gitRepository->list($conditions);
        $this->render('/Admin/git', ['gitList' => $data['gitList']]);
    }
}