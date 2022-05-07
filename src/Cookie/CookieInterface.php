<?php

namespace src\Cookie;

interface CookieInterface
{
   public  function set( string $name, string $value, int $expiry);
   public  function delete(string $name);
   public  function get(string $name) : string;
   public  function has(string $name) : bool;


}