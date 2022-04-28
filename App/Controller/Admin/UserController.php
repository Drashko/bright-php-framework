<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\User\UserDeleteRepositoryInterface;
use App\Repository\User\UserIdRepositoryInterface;
use App\Repository\User\UserListRepositoryInterface;
use App\Service\User\UserCreateServiceInterface;
use App\Service\User\UserUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\NoReturn;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Logger\LoggerInterface;
use src\Utility\Route;

class UserController extends BaseController
{

    private UserListRepositoryInterface $userListRepository;

    private UserUpdateServiceInterface $userUpdateService;

    private UserIdRepositoryInterface $userIdRepository;

    private LoggerInterface $logger;

    private UserCreateServiceInterface $userCreateService;

    private UserDeleteRepositoryInterface $userDeleteRepository;

    /**
     * @param UserListRepositoryInterface $userListRepository
     * @param UserIdRepositoryInterface $userIdRepository
     * @param UserUpdateServiceInterface $userUpdateService
     * @param UserCreateServiceInterface $userCreateService
     * @param UserDeleteRepositoryInterface $userDeleteRepository
     * @param LoggerInterface $logger
     */
    public function __construct(UserListRepositoryInterface $userListRepository, UserIdRepositoryInterface $userIdRepository , UserUpdateServiceInterface $userUpdateService,UserCreateServiceInterface $userCreateService,UserDeleteRepositoryInterface $userDeleteRepository,  LoggerInterface $logger
        ){
        parent::__construct();
        $this->layout = 'admin';
        $this->userListRepository = $userListRepository;
        $this->userIdRepository = $userIdRepository;
        $this->userUpdateService = $userUpdateService;
        $this->userCreateService = $userCreateService;
        $this->userDeleteRepository = $userDeleteRepository;
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

    /**
     * After filter which is called after every controller. Can be used
     * for garbage collection
     *
     * @return array
     */
    protected function callAfterMiddlewares(): array
    {
        return [];
    }

    /**
     * @throws Exception
     */
    public function indexAction(){
        $conditions = Route::getUrlParam();
        $data = $this->userListRepository->list($conditions);
        $this->render('/Admin/user' , ['userList' => $data]);
    }

    /**
     * @throws NotFoundException
     */
    public function updateAction($id)
    {
        $data = ['errors' => '' , 'userData' => ''];
        if (!empty($_POST)) {
            $data = $this->userUpdateService->update($id, $_POST);
            if (!empty($data['errors'])) {
                $data['errors'] = $data;
            }else{
                Flash::add('The user has been successfully updated!');
                $this->logger->info('User with id updated');
            }
        }
        $data['userData'] = $this->userIdRepository->find($id);
        $this->render('/Admin/userUpdate', [ 'userData' => $data['userData'], 'errors' => $data['errors'] , 'id' => $id]);
    }


    public function createAction(){
        if ($this->input->isPost()) {
            $data = $this->userCreateService->create($_POST);
            if(!empty($data['errors'])) {
                $resp = ['success' => false, 'errors' => $data['errors']];
            }else{
                $resp = ['success' => true, 'userData' => $data];
                $this->logger->info('A new user has been created');
            }
            $this->jsonResponse($resp);

        }
    }


    /**
     * @param $id
     */
    #[NoReturn] public function deleteAction($id){
        if($this->input->isPost()){
            if($user = $this->userIdRepository->find($id)){
                if($this->userDeleteRepository->delete($user,$id)){
                    $resp = ['success' => true , 'message' => 'User deleted', 'userId' => $id];
                    $this->logger->info('User was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }

    /**
     * export users list in pdf format
     */
    public function exportPdf(){
    }
}