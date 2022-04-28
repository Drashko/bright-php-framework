<?php

namespace src\Flash;

use src\Factory\SessionFactory;

class Flash implements FlashInterface
{

    /** @string */
    protected const FLASH_KEY = 'flash_message';

    /**
     * @param string $message
     * @param string $type
     */
    public static function add(string $message, string $type = FlashTypes::SUCCESS) : void
    {
        $session = SessionFactory::make();
        if (!$session->has(self::FLASH_KEY)) {
            $session->set(self::FLASH_KEY, []);
        }
        $session->setArray(self::FLASH_KEY, ['message' => $message, 'type' => $type]);
    }

    public static function get()
    {
        if(isset($_SESSION[self::FLASH_KEY])){
            //delete the array but return the value
            $message = $_SESSION[self::FLASH_KEY];
            unset($_SESSION[self::FLASH_KEY]);
            return $message;
        }
    }


    /**
     * Returns the session based flash message
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public function flash(string $message, string $type = FlashTypes::SUCCESS)
    {
        $this->add($message, $type);

    }

}