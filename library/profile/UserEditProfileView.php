<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserEditProfile
 *
 * @author profesor
 */
class UserEditProfileView implements IMainPlaceDiv {
     private $pattern ;
    public function __construct() 
    {
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/editprofile.html";        
        
    }
    
    
    public function buildForm() 
    {
        
          
        
        
          $page =  file_get_contents($this->pattern);
          $page =  preg_replace('|{\$registration}|im',  LocationControler::getRegistrationPage() ,  $page);
         
          $page =  preg_replace('|{\$login}|im', NULL,  $page);
          $page =  preg_replace('|{\$loginmessage}|im',NULL,  $page);
          $page =  preg_replace('|{\$passwordmessage}|im', NULL,  $page);
         
          return $page;
          return $page;
        
    }
    //put your code here
}
