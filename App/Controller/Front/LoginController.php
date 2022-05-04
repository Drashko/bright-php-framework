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

    /**
     * before action filter
     */
    protected function before(){}

    /**
     * @throws Exception
     */
    public function indexAction(){
        $data = [];
        if(!empty($_POST)) {
            $data['errors'] = $this->userLoginService->login($_POST);
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