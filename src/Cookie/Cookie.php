<?php

namespace src\Cookie;

class Cookie implements CookieInterface
{

    /**
     * @param string $name
     * @param string $value
     * @param string $expiry
     * @return bool
     */
    public function set(string $name, string $value, int $expiry): bool
    {
        if(setCookie($name, $value, time()+$expiry, '/')) {
            return true;
        }
        return false;
    }
    /**
     * @param string $name
     * @return mixed
     */
    public function delete(string $name): mixed
    {
        $this->set($name, '', time() -1);
    }
    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return $_COOKIE[$name];
    }
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }
}