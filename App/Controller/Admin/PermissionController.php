<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Permission\PermissionRepositoryInterface;
use App\Service\Permission\PermissionCreateServiceInterface;
use App\Service\Permission\PermissionUpdateServiceInterface;
use Exception;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class PermissionController extends BaseController
{


    private PermissionRepositoryInterface $permissionRepository;

    private PermissionCreateServiceInterface $createPermissionService;

    private LoggerInterface $logger;


    private PermissionUpdateServiceInterface $permissionUpdateService;


    public function __construct(PermissionRepositoryInterface $permissionRepository, PermissionCreateServiceInterface $createPermissionService , PermissionUpdateServiceInterface $permissionUpdateService, LoggerInterface $logger){
        parent::__construct();
        $this->layout = 'admin';
        $this->permissionRepository = $permissionRepository;
        $this->createPermissionService = $createPermissionService;
        $this->permissionUpdateService = $permissionUpdateService;
        $this->logger = $logger;
    }

    protected function callBeforeMiddlewares() : array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array
    {
        return [];
    }

    /**
     * @throws Exception|NotFoundException
     */
    public function indexAction(){
        $conditions = [];
        $data = $this->permissionRepository->list($conditions);
        $this->render('/Admin/permission', ['permissionList' => $data]);
    }

    public function createAction()
    {
        if ($this->input->isPost()) {
            $data = $this->createPermissionService->create($_POST);
            if (!empty($data['errors'])) {
                $resp = ['success' => false, 'errors' => $data['errors']];
            } else {
                $resp = ['success' => true, 'userData' => $data];
                $this->logger->info('A new permission has been created');
            }
            $this->jsonResponse($resp);

        }
    }

    /**
     * @throws NotFoundException
     */
    public function updateAction($id)
    {
        $data = ['errors' => '' , 'permissionData' => ''];
        $data['data'] = $this->permissionRepository->find($id);
        if ($this->input->isPost()) {
            $data = $this->permissionUpdateService->update($_POST, $id);
            if (!empty($data['errors'])) {
                $data['errors'] = $data;
            }else{
                Flash::add('The permission has been successfully updated!');
                $this->logger->info('Permission with id updated');
            }
        }
        $this->render('/Admin/permissionUpdate', ['permissionData' => $data['data'], 'id' => $id]);
    }

    public function deleteAction($id)
    {

        if($this->input->isPost()){
            if($role = $this->permissionRepository->find($id)){
                if($this->permissionRepository->delete($role,$id)){
                    $resp = ['success' => true , 'message' => 'Permission deleted', 'userId' => $id];
                    $this->logger->info('Permission was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }

}