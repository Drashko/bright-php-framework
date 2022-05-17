<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Project\ProjectRepositoryInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class ProjectController extends BaseController {

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository){
        parent::__construct();
        $this->layout = 'admin';
        $this->projectRepository = $projectRepository;
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
        $conditions = [];
        $data = $this->projectRepository->list($conditions);
        $this->render('/Admin/project', ['projectList' => $data]);
    }

    /**
     * @throws NotFoundException
     */
    public function create(){
        if($this->request->isPost()){

        }
        $this->render('/Admin/projectCreate', []);
    }

    /**
     * @throws NotFoundException
     */
    public function detailAction($id){
        $conditions = [];
        //$data = $this->projectRepository->list($conditions);
        $this->render('/Admin/projectDetail', [ 'id' => $id]);
    }

}