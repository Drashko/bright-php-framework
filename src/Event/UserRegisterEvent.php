<?php

namespace src\Event;

class UserRegisterEvent
{
   public function onUserRegister(){
       echo 'User Event';
   }
}