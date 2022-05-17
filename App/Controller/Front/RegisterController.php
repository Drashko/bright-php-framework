<?php

namespace App\Controller\Front;

use App\Service\User\UserRegisterServiceInterface;
use Exception;
use src\Base\BaseController;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class RegisterController extends BaseController {

    /**
     * @var UserRegisterServiceInterface
     */
    private UserRegisterServiceInterface $userRegisterService;

    private LoggerInterface $logger;

    /**
     * @param UserRegisterServiceInterface $userRegisterService
     * @param LoggerInterface $logger
     */
    public function __construct(UserRegisterServiceInterface $userRegisterService, LoggerInterface $logger){
        parent::__construct();
        $this->userRegisterService = $userRegisterService;
        $this->logger = $logger;
    }

    /**
     * before and after filters
     */
    protected function callBeforeMiddlewares() : array { return [];}
    /**
     * @throws Exception
     */
    public function indexAction(){
        $data = [];
        if(!empty($_POST)) {
            $data['errors'] = $this->userRegisterService->register($_POST);
            if(empty($data['errors'])) {
                Flash::add('Welcome to Bright_PHP Framework ! The registration has been successful!');
                $this->logger->info('New user registration');
                $this->redirect('/');
            }
        }
        $this->render('/Front/register' , $data);

    }

    /**
     * after action filter
     */
    protected function callAfterMiddlewares() : array { return [];}

}