<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Role\RoleRepositoryInterface;
use App\Service\Role\RoleCreateServiceInterface;
use App\Service\Role\RoleUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class RoleController extends BaseController
{
    private RoleRepositoryInterface $roleRepository;

    private RoleCreateServiceInterface $roleCreateService;

    private LoggerInterface $logger;

    private RoleUpdateServiceInterface $roleUpdateService;


    public function __construct(RoleRepositoryInterface $roleRepository, RoleCreateServiceInterface $roleCreateService, RoleUpdateServiceInterface $roleUpdateService,  LoggerInterface $logger){
        parent::__construct();
        $this->layout = 'admin';
        $this->roleRepository = $roleRepository;
        $this->roleCreateService = $roleCreateService;
        $this->roleUpdateService = $roleUpdateService;
        $this->logger = $logger;
    }

    protected function callBeforeMiddlewares() : array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array {
        return  [];
    }

    /**
     * @throws Exception|NotFoundException
     */
    public function indexAction(){
        $conditions = [];
        $data = $this->roleRepository->list($conditions);
        $this->render('/Admin/role', ['roleList' => $data]);
    }

    /**
     *
     */
    public function createAction(){
        if ($this->request->isPost()) {
            $data = $this->roleCreateService->create($_POST);
            if(!empty($data['errors'])) {
                $resp = ['success' => false, 'errors' => $data['errors']];
            }else{
                $resp = ['success' => true, 'userData' => $data];
                $this->logger->info('A new role has been created');
            }
            $this->jsonResponse($resp);

        }
    }
    /**
     * @throws NotFoundException
     */
    public function updateAction($id)
    {
        $data = ['errors' => '' , 'roleData' => ''];
        $data['data'] = $this->roleRepository->find($id);
        if ($this->request->isPost()) {
            $data = $this->roleUpdateService->update($_POST, $id);
            if (!empty($data['errors'])) {
                $data['errors'] = $data;
            }else{
                Flash::add('The role has been successfully updated!');
                $this->logger->info('Role with id updated');
            }
        }
        //pr($data);
        $this->render('/Admin/roleUpdate', [ 'roleData' => $data['data'], 'errors' => $data['errors'] , 'id' => $id]);
    }
    /**
     * @param $id
     */
    #[NoReturn] public function deleteAction($id){
        if($this->request->isPost()){
            if($role = $this->roleRepository->find($id)){
                if($this->roleRepository->delete($role,$id)){
                    $resp = ['success' => true , 'message' => 'Role deleted', 'userId' => $id];
                    $this->logger->info('Role was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }


}