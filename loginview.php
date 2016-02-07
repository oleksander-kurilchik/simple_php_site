<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginview
 *
 * @author profesor
 */
class LoginView {
   public $login;
   public $loginmessage;
   Public $passwordmessage;
   public $flag_remember;
   
   public function __construct()
           {
       
   }
   public function buildView()
   {
        $page =  file_get_contents("login.html");
          $page =  preg_replace('|{\$login}|im', $this->login,  $page);
          $page =  preg_replace('|{\$loginmessage}|im', $this->loginmessage,  $page);
          $page =  preg_replace('|{\$passwordmessage}|im', $this->passwordmessage,  $page);
         
          return $page;
       
       
   }


   //put your code here
}
