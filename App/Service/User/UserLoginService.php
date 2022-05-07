<?php
declare(strict_types=1);

namespace App\Service\User;
use App\Entity\UserSessionEntity;
use App\Repository\User\UserEmailRepositoryInterface;
use App\Repository\UserSession\UserSessionRepositoryInterface;
use Exception;
use PDO;
use src\Config\Config;
use src\Cookie\CookieInterface;
use src\DataMapper\DataMapperInterface;
use src\Factory\SessionFactory;
use src\Session\Session;
use src\Utility\Sanitizer;
use src\Utility\Validator;

class UserLoginService implements UserLoginServiceInterface
{


    /*** @var array $error
     */
    protected array $error = [];
    /**
     * @var bool
     */
    protected bool $bruteForce = false;
    /**
     * @var object
     */
    private object $validatedUser;
    /**
     * @var UserEmailRepositoryInterface
     */
    private UserEmailRepositoryInterface $userEmailRepository;
    /**
     * @var UserSessionRepositoryInterface
     */
    private UserSessionRepositoryInterface $userSessionRepository;
    /**
     * @var UserSessionEntity
     */
    private UserSessionEntity $userSessionEntity;
    /**
     * @var Session
     */
    private Session $session;
    /**
     * @var DataMapperInterface
     */
    private DataMapperInterface $dataMapper;

    private CookieInterface $cookie;

    public function __construct(DataMapperInterface $dataMapper, UserEmailRepositoryInterface $userEmailRepository, UserSessionRepositoryInterface $userSessionRepository, UserSessionEntity $userSessionEntity , CookieInterface $cookie)
    {
        $this->dataMapper = $dataMapper;
        $this->userEmailRepository = $userEmailRepository;
        $this->userSessionRepository = $userSessionRepository;
        $this->userSessionEntity =$userSessionEntity;
        $this->session   = SessionFactory::make();
        $this->cookie = $cookie;

    }

    /**
     * @param array|null $data
     * @return array|null
     * @throws Exception
     */
    public function loginValidate(array $data = null): ?array
    {
        $this->validate($data);
        if(!empty($this->error)) {
            return $this->error;
        }
        return null;
    }

    /**
     * @return false|void
     */
    public function loginFromCookie(){
        $cookieName = $this->cookie->get('login_cookie_name');
        if(! $this->cookie->has($cookieName)) return false;
        $hash = $this->cookie->get($cookieName);
        $session = $this->userSessionRepository->findByHash($hash);
        if(empty($session)) return false;
        //find the user by id
        //and log him in
        //redirect to home page or admin

        //$user = User->findById($session_>userId);
        //if($user){
        //user->login(true);//pass remember me to true
        //}
    }

    /**
     * @param $rememberMe
     * @return bool
     */
    public function rememberMe($rememberMe): bool
    {
        if(isset($data['remember_me'])){
            $now = time();
            $newHash = md5("{$this->session->get('userId')} {$now}");
            $session = $this->userSessionRepository->findByUserId($this->session->get('userId'));
            //if not found - create new 'user_session table' record
            if(empty($session)){
                $sessionEntity = $this->userSessionEntity
                    ->setUserId((int) $this->session->get('userId'))
                    ->setHash($newHash);
                $this->userSessionRepository->create($sessionEntity);
                //set cookie
                $this->cookie->set(Config::get('app', 'login_cookie_name'), $newHash , 60 * 60 * 24 * 30);
            }
            return true;
        }
        return false;
    }

    public function login(Object $user, $remember_me){
        //returns authenticated user object
        //if
    }

    public function authenticate(string $email){

        if($this->userEmailRepository->find($email)){
            return  $this->userEmailRepository->find($email);
        }
        return null;
        /// //$this->validate
        /// //if ($this->user->user_failed_logins !==0) {
        //                        $this->forceReset();
        //                    }
       //return authenticated user object or null
    }

    /**
     * @throws Exception
     */
    public function validate(array $data): void
    {
        $sanitized = Sanitizer::clean($data);

        if (!empty($sanitized['email']))
            if (!Validator::email($sanitized['email'])) {
                $this->error[] = 'Please enter a valid email address!';
            }
        //if not an email has been found
        if (empty($this->userEmailRepository->find($sanitized['email']))) {
            $this->error[] = 'Wrong email!';
        }
        if ($userEntity = $this->authenticate($sanitized['email'])) {
            if (!password_verify($sanitized['password'], $userEntity->getPassword())) {
                $this->error[] = 'Wrong password, please try again!';
                //each time add 1 to login attempts
                $this->forceDetected($sanitized['email']);
                //if($userEntity->getFailedLogins() >= $this->config->get('app', 'login_attempts')){//get it from config file as a settign
               // }
                if (($userEntity->getFailedLogins() >= (int)Config::get('app', 'login_attempts')) && ($userEntity->getLastFailedLogin() > (time() - (int)Config::get('app', 'login_timeout')))) {
                    $this->error[] = 'You"ve reached the maximum of 3 wrong password attempts, please  wait for 3 minutes and try again!';
                    $this->bruteForce = true;
                }
                //$this->forceReset($userEntity->getId());
            }
            session_regenerate_id(true);
            $this->session->set('userId', $userEntity->getId());
        }
        //return $this->error;
    }

    /**
     * @param string $email
     */
    public function forceDetected(string $email){
        if(!empty($email))
            $sql = "UPDATE `users` SET failed_logins = failed_logins + 1 , last_failed_login = :last_failed_login WHERE email = :email";
            $stm = $this->dataMapper->raw($sql);
            $stm->execute(['email' => $email, 'last_failed_login' => time()]);
    }

    /**
     * reset failed_logins counter for that id user
     *
     * @param $id
     */
    public function forceReset($id){
        $sql = "UPDATE `users` SET failed_logins = 0, last_failed_login = NULL WHERE id = :id AND failed_logins !=0";
        $stm = $this->dataMapper->raw($sql);
        $stm->execute(['id' => $id]);
    }






}