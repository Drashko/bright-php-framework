<?php

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Message\MessageRepositoryInterface;
use App\Repository\UserListRepository;
use App\Repository\UserListRepositoryInterface;
use Exception;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;

class MessageController extends BaseController
{


    private MessageRepositoryInterface $messageRepository;


    public function __construct(MessageRepositoryInterface $messageRepository){
        parent::__construct();
        $this->layout = 'admin';
        $this->messageRepository = $messageRepository;
    }

    protected function callBeforeMiddlewares() : array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array
    {
        return [];
    }

    /**
     * @throws Exception
     * @throws NotFoundException
     */
    public function indexAction(){
        $conditions = [];
        $data = $this->messageRepository->list($conditions);
        $this->render('/Admin/message' , ['messageList' => $data]);
    }

    /**
     * @throws NotFoundException
     */
    public function updateAction($id)
    {
        $data = ['errors' => '' , 'messageData' => ''];
        $data['data'] = $this->messageRepository->find($id);
        if ($this->request->isPost()) {
            $data = $this->messageRepository->update($_POST, $id);
            if (!empty($data['errors'])) {
                $data['errors'] = $data;
            }else{
                Flash::add('The role has been successfully updated!');
                $this->logger->info('Role with id updated');
            }
        }
        $this->render('/Admin/messageUpdate', [ 'messageData' => $data['data'], 'errors' => $data['errors'] , 'id' => $id]);

    }


}