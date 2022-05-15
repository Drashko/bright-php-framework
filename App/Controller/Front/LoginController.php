<?php

namespace App\Controller\Front;

use App\Service\Auth\AuthenticateServiceInterface;
use App\Service\User\UserLoginServiceInterface;
use Exception;
use src\Base\BaseController;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class LoginController extends BaseController {

    /**
     * @var AuthenticateServiceInterface
     */
    private AuthenticateServiceInterface $authenticateService;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(AuthenticateServiceInterface $authenticateService, LoggerInterface $logger){
        parent::__construct();
        $this->authenticateService = $authenticateService;
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
        if($this->request->isPost()) {
            $authService = $this->authenticateService->authenticate($_POST['email'], $_POST['password']);
            $remember_me = isset($_POST['remember_me']);
            if($authService){
                $this->authenticateService->logIn($authService, $remember_me);
                Flash::add('Welcome back. You are successfully logged in.');
                $this->logger->info('A user just logged in.');
                $this->redirect('admin/dashboard/index/');
            }else{
                $data['errors'] = $this->authenticateService->getErrors();
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