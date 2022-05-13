<?php

namespace App\Controller\Front;

use App\Service\Auth\AuthenticateServiceInterface;
use Exception;
use src\Base\BaseController;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class LogoutController extends BaseController {

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
        if($this->input->isGet()) {
            if ($this->authenticateService->logOut()) {
                $resp = ['success' => true];
                $this->logger->info('A user just logged out');
            } else {
                $resp = ['success' => false, 'error' => 'Error logging out!'];
            }
            $this->jsonResponse($resp);
        }
    }


    protected function after(){}
}