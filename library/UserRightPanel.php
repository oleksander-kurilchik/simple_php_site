<?php
ini_set('include_path', '/var/www/server3/interfaces');
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IRightPanelDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/SessionControler.php';

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
     private $pattern ;
     private $pattern_admin_panel ;
     private $page;
    public function __construct() 
    {
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/userrightpanel.html";
          $this->pattern_admin_panel = $_SERVER['DOCUMENT_ROOT']."/forms/adminpanelitem.html";
         
         $arr_arg = array();
         
         
         if(SessionControler::isAdmin())
         {
             $admin_panel = new BaseView(array("admin_address"=>LocationControler::getAdminPage()), $this->pattern_admin_panel);
             $arr_arg["admin_panel"]=$admin_panel->__ToString();
         }
         $arr_arg["user_profile"]= LocationControler::getProfillePage()."?mode=viewprofile" ;
         $arr_arg["user_publications"]= LocationControler::getProfillePage()."?mode=publications" ;
         $arr_arg["create_publication"]= LocationControler::getCreatingPublicationPage() ;
         $arr_arg["exit_address"]= LocationControler::getExitPage() ;
         
         $this->page = new BaseView($arr_arg, $this->pattern);
         $this->page->deleteAllMarks();
    }
    
    
    public function buildForm() 
    {
          
        
         
          return $this->page->__ToString();
        
    }
}
