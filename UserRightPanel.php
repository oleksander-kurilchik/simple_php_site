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
 * Description of UserRightPanel
 *
 * @author profesor
 */
class UserRightPanel implements IRightPanelDiv {
    //put your code here
     private $pattern = "./forms/userrightpanel.html";
    public function __construct() 
    {
        
        
    }
    
    
    public function buildForm() 
    {
          $page =  file_get_contents($this->pattern);
          $page =  preg_replace('|{\$user}|im', LocationControler::getProfillePage()."?mode=viewprofile" ,  $page);
         
          $page =  preg_replace('|{\$mypublications}|im', LocationControler::getProfillePage()."?mode=publications",  $page);
          $page =  preg_replace('|{\$exitaddr}|im',LocationControler::getExitPage(),  $page);
        
         
          return $page;
        
    }
}
