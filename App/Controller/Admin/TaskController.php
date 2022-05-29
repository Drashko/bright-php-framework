<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Project\ProjectRepositoryInterface;
use App\Repository\Task\TaskRepositoryInterface;
use App\Repository\User\UserListRepositoryInterface;
use App\Service\Task\TaskCreateServiceInterface;
use App\Service\Task\TaskUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Utility\Route;

class TaskController extends BaseController {

    private TaskRepositoryInterface $taskRepository;
    private TaskCreateServiceInterface $createService;
    private TaskUpdateServiceInterface $taskUpdateService;
    private UserListRepositoryInterface $userListRepository;
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, TaskCreateServiceInterface $createService, TaskUpdateServiceInterface $taskUpdateService, UserListRepositoryInterface $userListRepository, ProjectRepositoryInterface $projectRepository){
        parent::__construct();
        $this->taskRepository = $taskRepository;
        $this->createService = $createService;
        $this->taskUpdateService = $taskUpdateService;
        $this->userListRepository = $userListRepository;
        $this->projectRepository = $projectRepository;
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
        $data['taskList'] = $this->taskRepository->listAll($conditions);
        $data['userList'] = $this->userListRepository->list([]);
        $data['projectList'] = $this->projectRepository->list([]);
        $this->render('/Admin/task', ['taskList' =>$data['taskList'], 'userList' => $data['userList'], 'projectList' => $data['projectList']]);
    }

    /**
     * @throws NotFoundException
     */
    public function create(){
        $data['userList'] = $this->userListRepository->list([]);
        $data['projectList'] = $this->projectRepository->list([]);
        if($this->request->isPost()){
            $taskData = $this->createService->create($_POST);
            if(!empty($data))//newly created task data
                $this->redirect("/admin/task/detail/{$taskData->getId()}");
        }else{
            $this->render('/Admin/taskCreate', ['userList' => $data['userList'], 'projectList' => $data['projectList']]);
        }

    }
    /**
     * @throws NotFoundException
     */
    public function detailAction($id){
        $data['userList'] = $this->userListRepository->list([]);
        $data['projectList'] = $this->projectRepository->list([]);
        if($this->request->isPost()){
            $this->taskUpdateService->update($_POST, $id);
            Flash::add('The task has been successfully updated!');
        }
        $taskData = $this->taskRepository->find($id);
        $this->render('/Admin/taskDetail', [ 'taskData' => $taskData ,  'id' => $id, 'userList' => $data['userList'], 'projectList' => $data['projectList']]);
    }

    public function deleteAction($id)
    {

        if($this->request->isPost()){
            if($task = $this->taskRepository->find($id)){
                if($this->taskRepository->delete($task,(int) $id)){
                    $resp = ['success' => true , 'message' => 'Task deleted', 'userId' => $id];
                   // $this->logger->info('Project was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }




}