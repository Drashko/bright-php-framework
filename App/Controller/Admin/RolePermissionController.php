<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\RolePermission\RolePermissionRepositoryInterface;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class RolePermissionController extends BaseController
{
    private RolePermissionRepositoryInterface $rolePermissionRepository;

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RolePermissionRepositoryInterface $rolePermissionRepository, RoleRepositoryInterface $roleRepository){
        parent::__construct();
        $this->layout = 'admin';
        $this->rolePermissionRepository = $rolePermissionRepository;
        $this->roleRepository = $roleRepository;
    }

    protected function callBeforeMiddlewares() : array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array {
        return [];
    }

    /**
     * @throws Exception|NotFoundException
     */
    public function indexAction(){
        $data = ['roleList' => '' , 'rolePermissionList' => ''];
        $data['roleList'] = $this->roleRepository->list($conditions=[]);
        if($this->request->isGet()) {
            $roleId = $this->request->get('role_id');
            if(!empty($roleId)) {
                $data['rolePermissionList'] = $this->rolePermissionRepository->list(['role_id' => $roleId]);
            }
        }
        $this->render('/Admin/rolePermission', ['roleList' => $data['roleList'], 'rolePermissionList' => $data['rolePermissionList']]);
    }

    #[NoReturn] public function assignAction(){
        if($this->request->isPost()){
           // $data = [];
            $roleId = $this->request->get('role_id');
            $data = $this->rolePermissionRepository->assign($roleId, $_POST['permission']);
            if(!$data) {
                $resp = ['success' => false];
            }else{
                $resp = ['success' => true];
                //$this->logger->info('A new user has been created');
            }
        }
        $this->jsonResponse($resp);


    }
}