<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IRightPanelDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminRightPanel
 *
 * @author profesor
 */
class AdminRightPanel implements IRightPanelDiv
{
    private $activesection;
    private $pattern;
    public function __construct()
    {
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/adminrightpanel.html";
        
    }
    
    
    
    public function buildForm()
    {
           $page =  file_get_contents($this->pattern);
          $page =  preg_replace('|{\$userlist}|im', LocationControler::getAdminPage()."?section=userlisl" ,  $page);
         
          $page =  preg_replace('|{\$publist}|im', LocationControler::getAdminPage()."?section=publications",  $page);         
          $page =  preg_replace('|{\$commentlist}|im',LocationControler::getAdminPage()."?section=comments",  $page);
         $page =  preg_replace('|{\$exitaddr}|im',LocationControler::getExitPage(),  $page);
         
          return $page;
        
        
        
        
    }
    public function setActiveSection($act_sect)
     {
        $this->activesection = $act_sect;
        
        
    }

//put your code here
}
