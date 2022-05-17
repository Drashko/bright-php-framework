<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Project\ProjectRepositoryInterface;
use App\Service\Project\ProjectCreateServiceInterface;
use App\Service\Project\ProjectUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;

class ProjectController extends BaseController {

    private ProjectRepositoryInterface $projectRepository;

    private ProjectCreateServiceInterface $projectCreateService;

    private ProjectUpdateServiceInterface $projectUpdateService;

    public function __construct(ProjectRepositoryInterface $projectRepository, ProjectCreateServiceInterface $projectCreateService, ProjectUpdateServiceInterface $projectUpdateService){
        parent::__construct();
        $this->layout = 'admin';
        $this->projectRepository = $projectRepository;
        $this->projectCreateService = $projectCreateService;
        $this->projectUpdateService = $projectUpdateService;
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
            $data = $this->projectCreateService->create($_POST);
            if($data)//newly created project data
                $this->redirect("/admin/project/detail/{$data->getId()}");
        }else{
            $this->render('/Admin/projectCreate', []);
        }

    }

    /**
     * @throws NotFoundException
     */
    public function detailAction($id){
        if($this->request->isPost()){
            $this->projectUpdateService->update($_POST, $id);
            Flash::add('The project has been successfully updated!');
        }
        $data = $this->projectRepository->find($id);
        $this->render('/Admin/projectDetail', [ 'projectData' => $data ,  'id' => $id]);
    }

}