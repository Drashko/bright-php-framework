<?php
require_once 'autoload.php';
//front
use App\Controller\Admin\PermissionController;
use App\Controller\Admin\RoleController;
use App\Controller\Front\HomeController;
use App\Controller\Front\LoginController;
use App\Controller\Front\RegisterController;
//admin
use App\Controller\Admin\UserController as UserAdminController;
//repository
use App\Repository\Message\MessageRepository;
use App\Repository\Permission\PermissionRepository;
use App\Repository\Project\ProjectRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\RolePermission\RolePermissionRepository;
use App\Repository\User\UserCreateRepositoryInterface;
use App\Repository\User\UserDeleteRepository;
use App\Repository\User\UserEmailRepository;
use App\Repository\User\UserCreateRepository;
use App\Repository\User\UserIdRepository;
use App\Repository\User\UserListRepositoryInterface;
use App\Repository\User\UserListRepository;
use App\Repository\User\UserUpdateRepository;
//services
use App\Repository\UserSession\UserSessionRepository;
use App\Service\Auth\AuthenticateService;
use App\Service\Permission\PermissionCreateService;
use App\Service\Permission\PermissionUpdateService;
use App\Service\User\UserCreateService;
use App\Service\User\UserLoginService;
use App\Service\User\UserRegisterService;
use App\Service\User\UserRegisterServiceInterface;
use App\Service\User\UserUpdateService;
//cookie
use src\Cookie\Cookie;
use src\Cookie\CookieInterface;
//database
use src\Database\DatabaseConnectionInterface;
use src\Database\PDOConnection;
//data mapper
use src\DataMapper\DataMapper;
use src\DataMapper\DataMapperInterface;
//entity
use src\Entity\Entity;
use App\Entity\UserEntity;
//logger
use src\Logger\LoggerInterface;
use src\Logger\Logger;
//query builder
use src\QueryBuilder\QueryBuilder;
use src\QueryBuilder\QueryBuilderInterface;

use src\Template\Template;

return [
    //resolve core application classes
    'Template' => \DI\create('Template'),
    'PDOConnection' => \DI\autowire('src\Database\PDOConnection'),
    'QueryBuilder' => \DI\autowire('src\QueryBuilder\QueryBuilder'),
    'UserEntity' => \DI\autowire('App\Entity\UserEntity'),
    'Router' => \DI\create('src\Base\Router'),
    //resolve=ing interfaces
    LoggerInterface::class => \DI\create(Logger::class),
    CookieInterface::class => \DI\create(Cookie::class),
    DatabaseConnectionInterface::class => \DI\autowire(PDOConnection::class),
    QueryBuilderInterface::class => \DI\autowire(QueryBuilder::class),
    DataMapperInterface::class => \DI\autowire(DataMapper::class),
    UserListRepositoryInterface::class => \DI\autowire(UserListRepository::class),
    UserRegisterServiceInterface::class => \DI\autowire(UserRegisterService::class),
    UserCreateRepositoryInterface::class => \DI\autowire(UserCreateRepository::class),
    \App\Repository\User\UserUpdateRepositoryInterface::class => \DI\autowire(UserUpdateRepository::class),
    \App\Repository\User\UserEmailRepositoryInterface::class => \DI\autowire(UserEmailRepository::class),
    \App\Repository\User\UserIdRepositoryInterface::class => \DI\autowire(UserIdRepository::class),
    \App\Repository\User\UserDeleteRepositoryInterface::class => \DI\autowire(UserDeleteRepository::class),
    \App\Repository\Project\ProjectRepositoryInterface::class => \DI\autowire(ProjectRepository::class),
    \App\Repository\UserSession\UserSessionRepositoryInterface::class => \DI\autowire(UserSessionRepository::class),

    //resolving Services
    \App\Service\User\UserLoginServiceInterface::class => \DI\autowire(UserLoginService::class),
    \App\Service\User\UserUpdateServiceInterface::class => \DI\autowire(UserUpdateService::class),
    \App\Service\User\UserCreateServiceInterface::class => \DI\autowire(UserCreateService::class),
    \App\Service\User\UserFindIdServiceInterface::class => \DI\autowire(\App\Service\User\UserFindIdService::class),
    \App\Service\Auth\AuthenticateServiceInterface::class => \DI\autowire(\App\Service\Auth\AuthenticateService::class),

    \App\Service\Contract\FindByNameServiceInterface::class => \DI\autowire(\App\Service\Role\FindByNameService::class),
    \App\Service\Contract\FindByNameServiceInterface::class => \DI\autowire(\App\Service\Permission\FindByNameService::class),
    \App\Service\Role\RoleCreateServiceInterface::class => \DI\autowire(\App\Service\Role\RoleCreateService::class),
    \App\Service\Role\RoleUpdateServiceInterface::class => \DI\autowire(\App\Service\Role\RoleUpdateService::class),
    \App\Repository\Role\RoleRepositoryInterface::class => \DI\autowire(RoleRepository::class),
    \App\Service\Permission\PermissionCreateServiceInterface::class => \DI\autowire(PermissionCreateService::class),
    \App\Service\Permission\PermissionUpdateServiceInterface::class => \DI\autowire(PermissionUpdateService::class),
    \App\Service\Message\MessageCreateServiceInterface::class => \DI\autowire(\App\Service\Message\MessageCreateService::class),
    \App\Service\Project\ProjectCreateServiceInterface::class => \DI\autowire(\App\Service\Project\ProjectCreateService::class),
    \App\Service\Project\ProjectUpdateServiceInterface::class => \DI\autowire(\App\Service\Project\ProjectUpdateService::class),
    \App\Service\Client\ClientCreateServiceInterface::class => \DI\autowire(\App\Service\Client\ClientCreateService::class),
    \App\Service\Client\ClientUpdateServiceInterface::class => \DI\autowire(\App\Service\Client\ClientUpdateService::class),
    \App\Repository\Permission\PermissionRepositoryInterface::class => \DI\autowire(PermissionRepository::class),
    \App\Repository\RolePermission\RolePermissionRepositoryInterface::class => \DI\autowire(RolePermissionRepository::class),
    \App\Repository\Message\MessageRepositoryInterface::class => \DI\autowire(MessageRepository::class),
    \App\Repository\Client\ClientRepositoryInterface::class => \DI\autowire(\App\Repository\Client\ClientRepository::class),
    \App\Repository\Task\TaskRepositoryInterface::class => \DI\autowire(\App\Repository\Task\TaskRepository::class),
    \App\Repository\Activity\ActivityRepositoryInterface::class => \DI\autowire(\App\Repository\Activity\ActivityRepository::class),

    //\App\Service\Auth\Authenticated::class => \DI\autowire()->method('initAuth', AuthenticateService::class ),

    //resolving repositories
    'UserListRepository' => function(\Psr\Container\ContainerInterface $c){
        return new UserListRepository($c->get('DataMapper'));
    },
    'UserCreateRepository' => function(\Psr\Container\ContainerInterface $c){
        return new UserCreateRepository($c->get('DataMapper'));
    },
    'UserUpdateRepository' => function(\Psr\Container\ContainerInterface $c){
        return new UserUpdateRepository($c->get('DataMapper'));
    },
    'UserDeleteRepository' => function(\Psr\Container\ContainerInterface $c){
        return new UserDeleteRepository($c->get('DataMapper'));
    },
    //resolve services
    'UserCreateRepositoryService' => function(\Psr\Container\ContainerInterface $c){
        return new UserRegisterService($c->get('DataMapper'),$c->get('UserEntity'), $c->get('RegisterValidation'));
    },

    //resolve controllers
    'HomeController' => function(\Psr\Container\ContainerInterface $c){
        return new HomeController($c->get('UserListRepository'));
    },
    'LoginController' => function(\Psr\Container\ContainerInterface $c){
        return new LoginController($c->get('UserLoginService'),$c->get('Logger'));
    },
    'RegisterController' => function(\Psr\Container\ContainerInterface $c){
        return new RegisterController($c->get('UserRegisterService'),$c->get('Logger'));
    },
    //admin
    'UserController' => function(\Psr\Container\ContainerInterface $c){
        return new UserAdminController($c->get('UserListRepository'), $c->get('UserIdRepository'), $c->get('UserUpdateService'), $c->get('UserCreateService'), $c->get('UserDeleteRepository'), $c->get('Logger'));
    },
    'RoleController' => function(\Psr\Container\ContainerInterface $c){
        return new RoleController($c->get('RoleRepository'),$c->get('RoleCreateService'),$c->get('RoleUpdateService'),$c->get('Logger'));
    },
    'PermissionController' => function(\Psr\Container\ContainerInterface $c){
        return new PermissionController($c->get('PermissionRepository'),$c->get('PermissionCreateService'),$c->get('PermissionUpdateService'),$c->get('Logger'));
    },
];