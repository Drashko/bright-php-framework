<?php
declare(strict_types=1);

namespace App\Controller\Front;

use src\Base\BaseController;

class UserController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

    public function indexAction(){
        echo ' <h3>USER Controller indexAction</h3>';
    }

    public function addAction(){
        echo ' <h3>USER Controller addAction</h3>';
    }
    public function editAction($id){
        echo ' <h3>USER Controller editAction</h3>';
    }
}
