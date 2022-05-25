<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Client\ClientRepositoryInterface;
use App\Service\Client\ClientCreateServiceInterface;
use App\Service\Client\ClientUpdateServiceInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;
use src\Exception\NotFoundException;
use src\Flash\Flash;
use src\Logger\LoggerInterface;

class ClientController extends BaseController {

    /**
     * @var ClientRepositoryInterface
     */
    private ClientRepositoryInterface $clientRepository;
    /**
     * @var ClientCreateServiceInterface
     */
    private ClientCreateServiceInterface $clientCreateService;
    /**
     * @var ClientUpdateServiceInterface
     */
    private ClientUpdateServiceInterface $clientUpdateService;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(ClientRepositoryInterface $clientRepository, ClientCreateServiceInterface $clientCreateService, ClientUpdateServiceInterface $clientUpdateService, LoggerInterface $logger){
        parent::__construct();
        $this->clientRepository = $clientRepository;
        $this->clientCreateService = $clientCreateService;
        $this->clientUpdateService = $clientUpdateService;
        $this->logger = $logger;
        $this->layout = 'admin';
    }

    /**
     * Middleware which are executed before any action method is called
     * middlewares are returned within an array as either key/value pair.
     * @return array
     */
    #[ArrayShape(['RequireLoginMiddleware' => "string", 'HasPermissionMiddleware' => "string"])] protected function callBeforeMiddlewares(): array
    {
        return [
            'RequireLoginMiddleware' => RequireLoginMiddleware::class,
            'HasPermissionMiddleware' => HasPermissionMiddleware::class
        ];
    }

    protected function callAfterMiddlewares() : array{
        return [];
    }

    /**
     * @throws Exception
     */
    public function indexAction(){
        $conditions = [];
        $data = $this->clientRepository->list($conditions);
        $this->render('/Admin/client', ['clientList' => $data]);
    }

    /**
     * @throws NotFoundException
     */
    public function createAction(){
        if($this->request->isPost()){
            $data = $this->clientCreateService->create($_POST);
            if($data)//newly created project data
                $this->redirect("/admin/client/detail/{$data->getId()}");
        }else{
            $this->render('/Admin/clientCreate', []);
        }

    }

    /**
     * @throws NotFoundException
     */
    public function detailAction($id){
        if($this->request->isPost()){
            $this->clientUpdateService->update($_POST, $id);
            Flash::add('The client has been successfully updated!');
        }
        $data = $this->clientRepository->find($id);
        $this->render('/Admin/clientDetail', [ 'clientData' => $data ,  'id' => $id]);
    }

    public function deleteAction($id)
    {

        if($this->request->isPost()){
            if($role = $this->clientRepository->find($id)){
                if($this->clientRepository->delete($role,$id)){
                    $resp = ['success' => true , 'message' => 'Client deleted', 'userId' => $id];
                    $this->logger->info('Client was deleted');
                }else{
                    $resp = ['success' => false , 'message' => 'Something went wrong..'];
                }
            }
            $this->jsonResponse($resp);
        }
    }




}