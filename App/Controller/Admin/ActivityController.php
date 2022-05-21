<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Middleware\Before\HasPermissionMiddleware;
use App\Middleware\Before\RequireLoginMiddleware;
use App\Repository\Activity\ActivityRepositoryInterface;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use src\Base\BaseController;

class ActivityController extends BaseController {

    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository){
        parent::__construct();
        $this->activityRepository = $activityRepository;
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
        $conditions =[];
        $data = $this->activityRepository->list($conditions);
        $this->render('/Admin/activity', ['activityList' => $data]);
    }


}