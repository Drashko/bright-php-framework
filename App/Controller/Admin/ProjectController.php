<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Client\ClientRepositoryInterface;
use App\Repository\Project\ProjectRepositoryInterface;
use App\Service\Project\ProjectCreateServiceInterface;
use App\Service\Project\ProjectUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Logger\LoggerInterface;
use src\Utility\Route;

class ProjectController extends BaseController {

    private ProjectRepositoryInterface $projectRepository;

    private ProjectCreateServiceInterface $projectCreateService;

    private ProjectUpdateServiceInterface $projectUpdateService;

    private LoggerInterface $logger;

    private ClientRepositoryInterface $clientRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectCreateServiceInterface $projectCreateService,
        ProjectUpdateServiceInterface $projectUpdateService,
        ClientRepositoryInterface $clientRepository,
        LoggerInterface $logger){
        parent::__construct();
        $this->layout = 'admin';
        $this->projectRepository = $projectRepository;
        $this->projectCreateService = $projectCreateService;
        $this->projectUpdateService = $projectUpdateService;
        $this->clientRepository = $clientRepository;
        $this->logger = $logger;
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
        $data['projectList'] = $this->projectRepository->list($conditions);
        $data['clientList'] = $this->clientRepository->list([]);
        $this->render('/Admin/project', ['projectList' => $data['projectList'], 'clientList' => $data['clientList']]);
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

    public function deleteAction($id)
    {

        if($this->request->isPost()){
            if($role = $this->projectRepository->find($id)){
                if($this->projectRepository->delete($role,$id)){
                    $resp = ['success' => true , 'message' => 'Project deleted', 'userId' => $id];
                    $this->logger->info('Project was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }

}