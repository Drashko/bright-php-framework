<?php

namespace App\Controller\Front;

use App\Service\User\UserLoginServiceInterface;
use Exception;
use src\Base\BaseController;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class LoginController extends BaseController {

    /**
     * @var UserLoginServiceInterface
     */
    private UserLoginServiceInterface $userLoginService;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(UserLoginServiceInterface $userLoginService, LoggerInterface $logger){
        parent::__construct();
        $this->userLoginService = $userLoginService;
        $this->logger = $logger;
    }

    protected function callBeforeMiddlewares(): array
    {
        return [
            //check if the user in not already logged in
            //if so don show login form and redirect to home page or admin
        ];
    }

    /**
     * @throws Exception
     */
    public function indexAction(){
        $data = [];
        if($this->input->isPost()) {
            $data['errors'] = $this->userLoginService->loginValidate($_POST);
            if(empty($data['errors'])) {
                Flash::add('Welcome back. You are successfully logged in.');
                $this->logger->info('A user just logged in.');
                $this->redirect('/');
            }
        }
        $this->render('/Front/login' , $data);
    }

    public function loginFromCookie(){

    }
    /**
     * after action filter
     */
    protected function after(){}
}