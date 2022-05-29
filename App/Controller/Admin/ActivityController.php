<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Activity\ActivityRepositoryInterface;
use App\Repository\Project\ProjectRepositoryInterface;
use App\Repository\Task\TaskRepositoryInterface;
use App\Repository\User\UserListRepositoryInterface;
use App\Service\Activity\ActivityCreateServiceInterface;
use App\Service\Activity\ActivityUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Utility\Route;

class ActivityController extends BaseController {

    private ActivityRepositoryInterface $activityRepository;
    private ActivityCreateServiceInterface $activityCreateService;
    private ActivityUpdateServiceInterface $activityUpdateService;
    private ProjectRepositoryInterface $projectRepository;
    private UserListRepositoryInterface $userListRepository;
    private TaskRepositoryInterface $taskRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository, ActivityCreateServiceInterface $activityCreateService, ActivityUpdateServiceInterface $activityUpdateService, ProjectRepositoryInterface $projectRepository, UserListRepositoryInterface $userListRepository, TaskRepositoryInterface $taskRepository){
        parent::__construct();
        $this->activityRepository = $activityRepository;
        $this->activityCreateService = $activityCreateService;
        $this->activityUpdateService = $activityUpdateService;
        $this->projectRepository = $projectRepository;
        $this->userListRepository = $userListRepository;
        $this->taskRepository = $taskRepository;
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
        $data['activityList'] = $this->activityRepository->listAll($conditions);
        $data['userList']     = $this->userListRepository->list([]);
        $data['projectList']  = $this->projectRepository->list([]);
        $data['taskList']  = $this->taskRepository->list([]);
        $this->render('/Admin/activity', [ 'activityList' => $data['activityList'], 'userList' => $data['userList'], 'projectList' => $data['projectList'],'taskList' => $data['taskList']]);
    }

    /**
     * @throws NotFoundException
     */
    public function create(){
        $data['userList'] = $this->userListRepository->list([]);
        $data['projectList'] = $this->projectRepository->list([]);
        $data['taskList'] = $this->taskRepository->list([]);
        if($this->request->isPost()){
            $activityData = $this->activityCreateService->create($_POST);
            if(!empty($data))//newly created activity data
                $this->redirect("/admin/activity/detail/{$activityData->getId()}");
        }else{
            $this->render('/Admin/activityCreate', ['userList' => $data['userList'], 'projectList' => $data['projectList'], 'taskList' => $data['taskList']]);
        }

    }

    /**
     * @throws NotFoundException
     */
    public function detailAction($id){
        $data['userList'] = $this->userListRepository->list([]);
        $data['projectList'] = $this->projectRepository->list([]);
        $data['taskList'] = $this->taskRepository->list([]);
        //pr($data['taskList']);
        if($this->request->isPost()){
            $this->activityUpdateService->update($_POST, $id);
            Flash::add('The activity has been successfully updated!');
        }
        $activityData = $this->activityRepository->find($id);
        $this->render('/Admin/activityDetail', [ 'activityData' => $activityData ,  'id' => $id, 'userList' => $data['userList'], 'projectList' => $data['projectList'], 'taskList' => $data['taskList']]);
    }


    public function deleteAction($id)
    {

        if($this->request->isPost()){
            if($activity = $this->activityRepository->find($id)){
                if($this->activityRepository->delete($activity,(string) $id)){
                    $resp = ['success' => true , 'message' => 'Activity deleted', 'Id' => $id];
                    // $this->logger->info('Project was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }


}