<?php
declare(strict_types=1);

namespace App\Controller\Front;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Message\MessageRepositoryInterface;
use App\Service\Message\MessageCreateServiceInterface;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;

class ContactController extends BaseController
{
    /**
     * @var MessageCreateServiceInterface
     */
    private MessageCreateServiceInterface $messageCreateService;

    /**
     * @param MessageCreateServiceInterface $messageCreateService
     */
    public function __construct(MessageCreateServiceInterface $messageCreateService)
    {
        parent::__construct();
        $this->messageCreateService = $messageCreateService;

    }

    /**
     * @return array
     */
    #[ArrayShape(['RequireLoginMiddleware' => "string", 'HasPermissionMiddleware' => "string"])] protected function callBeforeMiddlewares() : array
    {
        return [];
    }

    protected function callAfterMiddlewares() : array
    {
        return [];
    }
    /**
     * @throws NotFoundException
     */
    public function indexAction(){
        if($this->request->isPost()){
            $data = $this->messageCreateService->create($_POST);
        }
        $this->render('/Front/contact' , []);
    }
}