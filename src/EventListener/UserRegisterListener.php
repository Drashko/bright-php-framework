<?php

namespace src\EventListener;

class UserRegisterListener
{
    //pass object as a param
   public function onUserRegister(){
       echo 'new User Registered right now';
   }

}