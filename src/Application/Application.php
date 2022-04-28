<?php
declare(strict_types=1);

namespace src\Application;

use src\Base\Exception\BaseNoValueException;
use src\Base\Exception\BaseUnexpectedValueException;
use src\Config\Config;
use src\Factory\ConfigFactory;
use src\Factory\RouterFactory;
use src\Factory\SessionFactory;
use src\Router\Router;
use src\Session\SessionInterface;



class Application
{
    /** @var string */
    protected string $appRoot;

    protected array $options = [];

    protected SessionInterface $session;

    protected Config $config;


    /**
     * Main class constructor
     *
     * @param string $appRoot
     */
    public function __construct(string $appRoot)
    {
        $this->appRoot = $appRoot;
        $this->session = SessionFactory::make();
        $this->config  = ConfigFactory::make();
    }

    /**
     * Execute at application level
     *
     * @return self
     */
    public function run() : self
    {
        $this->constants();
        if (version_compare($phpVersion = PHP_VERSION, $coreVersion = ApplicationConfig::MIN_PHP_VERSION, '<')) {
            die(sprintf('You are running PHP %s, the core framework requires at least PHP %s', $phpVersion, $coreVersion));
        }
        $this->environment();
        $this->errorHandler();
        return $this;
    }

    /**
     * Define framework and application directory constants
     *
     * @return void
     */
    private function constants() : void
    {
        defined('DS') or define('DS', '/');
        defined('APP_ROOT') or define('APP_ROOT', $this->appRoot);
        defined('CONFIG_PATH') or define('CONFIG_PATH', APP_ROOT . DS . 'Config');
        defined('TEMPLATE_PATH') or define('TEMPLATE_PATH', APP_ROOT . DS . 'App/Template');
        defined('LOG_DIR') or define('LOG_DIR', APP_ROOT . DS . 'Tmp/log');
        defined('BASE_URL') or define('BASE_URL', $_SERVER['REQUEST_SCHEME'] ."://". $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']);
        defined('INDEX_URL') or define('INDEX_URL', str_replace('Public/index.php', "" ,BASE_URL));

    }

    /**
     * Set default framework and application settings
     * add all php init settings here
     * @return void
     */
    private function environment()
    {

        ini_set('default_charset', 'UTF-8');
        ini_set('error_reporting', 'E_ALL');
        //int_set, cookie,session , and so on ...
    }

    /**
     * Convert PHP errors to exception and set a custom exception
     * handler. Which allows us to take control or error handling
     * so we can display errors in a customizable way
     *
     * @return void
     */
    private function errorHandler() : void
    {
        error_reporting(E_ALL | E_STRICT);
        set_error_handler([new \src\Exception\ExceptionHandler(), 'convertWarningAndNotice']);
        set_exception_handler([new \src\Exception\ExceptionHandler(), 'handle']);
    }

    public function setSession() : self
    {
        $this->session->start();
        return $this;
    }

    /**
     * @param string|null $url
     * @param array $routes
     * @return self
     *
     * @throws BaseNoValueException
     * @throws BaseUnexpectedValueException
     */
    public function setRouteHandler(string $url = null, array $routes = []) : self
    {
        $url = ($url) ? $url : $_SERVER['QUERY_STRING'];
        $routes = ($routes) ? $routes : $this->config->get('routes');
        $factory = new RouterFactory($url, $routes);
        $factory->create(Router::class)->buildRoutes();
        return $this;
    }
}