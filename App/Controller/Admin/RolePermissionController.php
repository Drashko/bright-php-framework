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
        if($this->input->isGet()) {
            $roleId = $this->input->get('role_id');
            if(!empty($roleId)) {
                $data['rolePermissionList'] = $this->rolePermissionRepository->list(['role_id' => $roleId]);
            }
        }
        $this->render('/Admin/rolePermission', ['roleList' => $data['roleList'], 'rolePermissionList' => $data['rolePermissionList']]);
    }

    #[NoReturn] public function assignAction(){
        //get post data with ajax and save to role_permission table
        //check for existing role_id AND permission_id records
        //if the same found do nothing else create new row
        //return message to the user
        if($this->input->isPost()){
           // $data = [];
            $roleId = $this->input->get('role_id');
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