<?php


require_once '/var/www/server3/interfaces/IRightPanelDiv.php';
require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/LoginFormPanelView.php';
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
    private $pattern;
    private $loginform;
    public function __construct() 
    {
        $this->loginform = new LoginFormPanelView(null);
        
        
        
    }
    
    
    public function buildForm() 
    {
          
          return $this->loginform;
        
    }

//put your code here
}
