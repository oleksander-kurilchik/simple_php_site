<?php
ini_set('include_path', '/var/www/server3/interfaces');

require_once 'IRightPanelDiv.php';
require_once 'LocationControler.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GuestRightPanel
 *
 * @author profesor
 */
class GuestRightPanel implements IRightPanelDiv{
    private $pattern = "./forms/loginbase.html";
    public function __construct() 
    {
        
        
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
