<?php

namespace App\Controller\Ui;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use src\Base\BaseController;
use src\Factory\SessionFactory;
use src\Session\Session;

class AdminNavigationController extends BaseController
{
    protected Session $session;

    public function __construct(){
        parent::__construct();
        $this->layout = 'admin';
        $this->session = SessionFactory::make();
    }
    /**
     * @throws Exception
     */
    public function indexAction(){}

    public function setActiveAction(){
        $resp = ['success' => true, 'data' => ''];
        if($this->input->isPost()){
            $open = $this->input->get('');
            $resp = ['success' => true, 'data' => ''];
        }
        $this->jsonResponse($resp);

    }
    public function getActiveAction($data){

    }
}