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

    /**
     * set menu class- 'uk-open' to clicked menu link
     */
    #[NoReturn] public function setActiveMenuLinkAction(){
        $resp = ['success' => true, 'data' => ''];
        if($this->input->isPost()){
            $link = $this->input->get('id');
            $this->session->set('menu-item-opened' ,$link);
            $resp = ['success' => true, 'data' => $link];
        }
        $this->jsonResponse($resp);

    }
    public function getActiveAction($data){

    }
}