<?php

namespace src\Session;

use src\Session\Exception\SessionInvalidArgumentException;

interface SessionInterface
{
    /**
     * sets a specific value to a specific key of the session
     * @param string $key   The key of the item to store.
     * @param mixed  $value The value of the item to store. Must be serializable.
     * @return void
     * @throws SessionInvalidArgumentException if the $key string is not a legal value.
     */
    public function set(string $key, mixed $value) : void;

    /**
     * Sets the specific value to a specific array key of the session
     * @param string $key   The key of the item to store.
     * @param mixed  $value The value of the item to store. Must be serializable.
     * @return void
     * @throws SessionInvalidArgumentException if the $key string is not a legal value.
     */
    public function setArray(string $key, mixed $value) : void;

    /**
     * gets/returns the value of a specific key of the session
     * @param string $key   The key of the item to store.
     * @param mixed|null $default the default value to return if the request value can't be found
     * @return mixed
     * @throws SessionInvalidArgumentException if the $key string is not a legal value.
     */
    public function get(string $key, mixed $default = null);

    /**
     * Removes the value for the specified key from the session
     * @param string $key The key of the item that will be unset.
     * @return void
     * @throws SessionInvalidArgumentException
     */
    public function delete(string $key) : void;

    /**
     * Destroy the session. Along with session cookies
     * @since 1.0.0
     * @return void
     */
    public function invalidate() : void;

    /**
     * Returns the requested value and remove it from the session
     * @param string $key - The key to retrieve and remove the value for.
     * @param null $value
     * @return mixed
     * @since 1.0.0
     */
    public function flush(string $key, $value = null): mixed;

    /**
     * Determines whether an item is present in the session.
     * @param string $key The session item key.
     * @return bool
     * @throws SessionInvalidArgumentException  MUST be thrown if the $key string is not a legal value.
     */
    public function has(string $key) : bool;
}