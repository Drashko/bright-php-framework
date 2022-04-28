<?php

namespace src\Session;

use JetBrains\PhpStorm\Pure;
use src\Base\Exception\BaseInvalidArgumentException;


class Session implements SessionInterface
{


    /**
     *
     */
    protected const SESSION_PATTERN = '/^[a-zA-Z0-9_\.]{1,64}$/';


    /**
     * Start session if we haven't already have a php session
     *
     * @return void
     */
    public function start()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    /**
     * Return the current session name
     *
     * @return string
     */
    public function getName() : string
    {
        return session_name();
    }

    /**
     * @param string $key
     * @param [type] $value
     * @return void
     */
    public function set(string $key, mixed $value) : void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @param [type] $value
     * @return void
     */
    public function setArray(string $key, mixed $value) : void
    {
        $_SESSION[$key][] = $value;
    }

    /**
     * @param string $key
     * @param [type] $default
     * @return void
     */
    public function get(string $key, mixed $default = null)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * @param string $key
     * @return void
     */
    public function delete(string $key) : void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @return void
     */
    public function invalidate() : void
    {
        $_SESSION = array();
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setCookie($this->getName(), '', time() - $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_unset();
        session_destroy();
    }

    /**
     * @param string $key
     * @param [type] $default
     * @return void
     */
    public function flush(string $key, $value = null) : mixed
    {
        if ($this->has($key)) {
            $value = $_SESSION[$key];
            $this->delete($key);
            return $value;
        }
        return $value;

    }

    /**
     * @param string $key
     * @return boolean
     */
    public function has(string $key) : bool
    {
        return isset($_SESSION[$key]);
    }
    /**
     * Checks whether our session key is valid according the defined regular expression
     *
     * @param string $key
     * @return boolean
     */
    protected function isSessionKeyValid(string $key) : bool
    {
        return (preg_match(self::SESSION_PATTERN, $key) === 1);
    }

    /**
     * Checks whether we have session key
     *
     * @param string $key
     * @return void
     * @throws BaseInvalidArgumentException
     */
    protected function ensureSessionKeyIsValid(string $key) : void
    {
        if ($this->isSessionKeyValid($key) === false) {
            throw new BaseInvalidArgumentException($key . ' is not a valid session key');
        }
    }

}