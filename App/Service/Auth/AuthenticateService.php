<?php
declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\UserSessionEntity;
use App\Repository\User\UserEmailRepositoryInterface;
use App\Repository\User\UserIdRepositoryInterface;
use App\Repository\UserSession\UserSessionRepositoryInterface;
use Exception;
use src\Config\Config;
use src\DataMapper\DataMapperInterface;
use src\Factory\SessionFactory;
use App\Entity\UserEntity;
use src\Session\Session;
use src\Utility\Sanitize;
use src\Utility\Token;
use src\Utility\Validator;

class AuthenticateService implements AuthenticateServiceInterface
{

    protected array $errors;

    /**
     * @var DataMapperInterface
     */
    private DataMapperInterface $dataMapper;
    /**
     * @var Session
     */
    protected Session $session;
    /**
     * @var UserSessionEntity
     */
    private UserSessionEntity $userSessionEntity;
    /**
     * @var UserSessionRepositoryInterface
     */
    private UserSessionRepositoryInterface $userSessionRepository;
    /**
     * @var UserIdRepositoryInterface
     */
    private UserIdRepositoryInterface $userIdRepository;

    /**
     * @var UserEmailRepositoryInterface
     */
    private UserEmailRepositoryInterface $userEmailRepository;
    /**
     * @var string
     */
    private ?string $remember_token = null;
    /**
     * @var int|float
     */
    private int|float $expiry_timestamp;
    /**
     * @var bool
     */
    private bool $bruteForce = false;



    public function __construct(DataMapperInterface $dataMapper, UserSessionEntity $userSessionEntity, UserSessionRepositoryInterface $userSessionRepository, UserIdRepositoryInterface $userIdRepository, UserEmailRepositoryInterface $userEmailRepository)
    {
        $this->dataMapper = $dataMapper;
        $this->userSessionEntity     = $userSessionEntity;
        $this->userSessionRepository = $userSessionRepository;
        $this->userIdRepository = $userIdRepository;
        $this->userEmailRepository = $userEmailRepository;
        $this->session = SessionFactory::make();
    }


    /**
     * @param UserEntity $userEntity
     * @param bool $remember_me
     * @return void
     * @throws Exception
     */
    public function logIn(UserEntity $userEntity, bool $remember_me = false): void
    {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userEntity->getId();
        if ($remember_me) {
            $this->createUserSession($userEntity->getId());
            setcookie('remember_me', $this->remember_token,  $this->expiry_timestamp, '/');
        }
    }

    /**
     * create new user_session ( remember me token and expire date )
     *
     * @throws Exception
     */
    public function createUserSession($userId): UserSessionEntity
    {
        //token settings
        $token = new Token();
        $hashed_token = $token->getHash();
        $this->remember_token = $token->getValue();
        $this->expiry_timestamp = time() + 60 * 60 * 24 * 30;//30 days from now
        $expire_at =  date('Y-m-d H:i:s', $this->expiry_timestamp);
        //create user_session record
        $userSession = $this->userSessionEntity
            ->setUserId($userId)
            ->setHash($hashed_token)
            ->setExpiresAt($expire_at);
        return $this->userSessionRepository->create($userSession);
    }

    /**
     * @param string $email
     * @param string $password
     * @return object|bool
     */
    public function authenticate(string $email, string $password): object | bool
    {
        $this->validate($email, $password);//return errors to the user
        if(empty($this->errors)){
            return $this->userEmailRepository->find($email);
        }
        return false;

    }


    public function validate($email, $password){
        //fill in $this->errors if any
        $email = Sanitize::sanitize($email, 'email');
        $password = Sanitize::sanitize($password, 'string');
        if (!empty($email))
            if (!Validator::email($email)) {
                $this->errors[] = 'Please enter a valid email address!';
            }
        // not an email has been found
        if (empty($this->userEmailRepository->find($email))) {
            $this->errors[] = 'Wrong email!';
        }
        if($userEntity = $this->userEmailRepository->find($email)){
            if (!password_verify($password, $userEntity->getPassword())) {
                $this->errors[] = 'Wrong password, please try again!';
                $this->forceDetected($email);
                if (($userEntity->getFailedLogin() >= (int)Config::get('app', 'login_attempts')) && ($userEntity->getLastFailedLogin() > (time() - (int)Config::get('app', 'login_timeout')))) {
                    $this->errors[] = 'You"ve reached the maximum of 3 wrong password attempts, please  wait for 3 minutes and try again!';
                    $this->bruteForce = true;
                }
            }
        }
    }

    /**
     * @return bool|UserEntity
     * @throws Exception
     */
    public function getLoggedInUser(): bool | UserEntity
    {
        if(isset($_SESSION['user_id'])){
            return $this->userIdRepository->find($_SESSION['user_id']);
        }else{
            return $this->loginFromCookie();
        }

    }

    /**
     * @throws Exception
     */
    public function loginFromCookie(): UserEntity|bool
    {
        $cookie = $_COOKIE['remember_me'] ?? false;
        if($cookie){
            //remembered token
            $user_session = $this->userSessionRepository->findByHash($cookie);
            if($user_session && (!$user_session->getExpiresAt() < time())){
                $userEntity = $this->userIdRepository->find($user_session->getUserId());
                $this->logIn($userEntity, false);
                return $userEntity;
            }
        }
        return false;
    }
    /**
     * @return bool
     */
    public function logOut(): bool
    {
        // Unset all of the session variables
        $_SESSION = [];
        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        //Finally destroy the session
        session_destroy();
        //delete user_session record from 'user_session table'
        if($this->forgetLogin()){
            return  true;
        };
        return true;
    }

    public function forgetLogin(){
        $cookie = $_COOKIE['remember_me'] ?? false;
        if($cookie) {
            $user_session = $this->userSessionRepository->findByHash($cookie);
            if($user_session) {
                $this->userSessionRepository->delete($user_session, $user_session->getId());
            }
            //pr($_COOKIE);
            setcookie('remember_me', "" , time()-3600, '/');  // set to expire in the past
            //pr($_COOKIE);
            return true;
        }
    }
    public function register( array $data) : object
    {
        // TODO: Implement register() method.
    }

    public function getErrors(): array

    {
        return $this->errors;
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