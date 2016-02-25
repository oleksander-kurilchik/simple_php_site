<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrationview
 *
 * @author profesor
 * E
 */
class RegistrationView {

    public $login;
       public $loginmessage;
    public $firstname;
    public $firstnamemessage;
    public $secondname;
    public $secondnamemessage;
    public $lastname;
    public $lastnamemessage;
    public $email;
    public $emailmessage;
    public $date_of_birth;
    public $date_of_birthmessage;
    public $address;
     public $addressmessage;
    public $password1_message;
    public $password2_message;
      public $sexmessage;

    public function __construct() {
       

    }

    public function BuildForm() {
        
        $page =  file_get_contents("registration.html");
        $page =  preg_replace('|{\$login}|im', $this->login,  $page);
        $page =  preg_replace('|{\$firtsname}|im', $this->firstname,  $page);
        $page =  preg_replace('|{\$secondname}|im', $this->secondname,  $page);
        $page =  preg_replace('|{\$lastname}|im', $this->lastname,  $page);
        $page =  preg_replace('|{\$date_of_bird}|im', $this->date_of_birth,  $page);
        $page =  preg_replace('|{\$email}|im', $this->email,  $page);
        $page =  preg_replace('|{\$address}|im', $this->address,  $page);
        
        
        $page =  preg_replace('|{\$loginmessage}|im', $this->loginmessage,  $page);
        $page =  preg_replace('|{\$firtsnamemessage}|im', $this->firstnamemessage,  $page);
        $page =  preg_replace('|{\$secondnamemessage}|im', $this->secondnamemessage,  $page);
        $page =  preg_replace('|{\$lastnamemessage}|im', $this->lastnamemessage,  $page);
        $page =  preg_replace('|{\$date_of_birdmessage}|im', $this->date_of_birthmessage,  $page);
        $page =  preg_replace('|{\$emailmessage}|im', $this->emailmessage,  $page);
        $page =  preg_replace('|{\$addressmessage}|im', $this->addressmessage,  $page);
       
        $page =  preg_replace('|{\$password_1message}|im', $this->password1_message,  $page);
        $page =  preg_replace('|{\$password_2message}|im', $this->password2_message,  $page);
         $page =  preg_replace('|{\$sexmessage}|im', $this->sexmessage,  $page);
        
        
       
        
        return $page;

    }

    public function addErrorMessage() {
        
    }
    
    
    

    //put your code here
}
