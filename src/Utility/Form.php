<?php

namespace src\Utility;
use JetBrains\PhpStorm\Pure;
use src\Factory\SessionFactory;

class Form
{
    private static \src\Session\Session $session;

    public function __construct(){
        self::$session = SessionFactory::make();
    }
    /**
     * Cleans user input with htmlentities
     * @method sanitize
     * @param string $dirty string of dirty user input
     * @return string string of cleaned user input
     */
    public static function sanitize(string $dirty): string
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Creates a csrf token and stores it in $_SESSION
     * @method generateToken
     * @return string        value of the token set in $_SESSION
     */
    public static function generateToken(): string
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        self::$session->set('csrf_token',$token);
        return $token;
    }

    /**
     * Check to see if the csrf token is valid
     * @method checkToken
     * @param string $token value that was posted
     * @return boolean returns wHether or not the token was correct
     */
    #[Pure] public static function checkToken(string $token): bool
    {
        return (self::$session->has('csrf_token') && self::$session->get('csrf_token') == $token);
    }

    /**
     * Creates a hidden input to be used in a form for csrf
     * @method csrfInput
     * @return string return html string for form input
     */
    public static function csrfInput(): string
    {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="'.self::generateToken().'" />';
    }
}