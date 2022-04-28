<?php
declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\User\UserListRepositoryInterface;
use App\Service\User\UserRegisterService;
use Exception;
use src\Base\BaseController;
use src\Factory\SessionFactory;

class HomeController extends BaseController {

    private UserListRepositoryInterface $userListRepository;

    /**
     * @param UserListRepositoryInterface $userListRepository
     */
    public function __construct( UserListRepositoryInterface $userListRepository){
        parent::__construct();
        $this->userListRepository = $userListRepository;
    }

    protected function before(){}
    protected function after(){}

    /**
     * @throws Exception
     */
    public function indexAction(){

        $this->render('/Front/home' , []);
    }
}
