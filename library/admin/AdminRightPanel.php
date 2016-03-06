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
     private $pattern ;
     private $page;
    public function __construct($selected=0 ) 
    {
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/adminrightpanel.html";
        $arr_arg["users"]=  LocationControler::getAdminPage()."?mode=userlisl" ;
        $arr_arg["publications"]=  LocationControler::getAdminPage()."?mode=publications" ;
        $arr_arg["comments"]=  LocationControler::getAdminPage()."?mode=comments" ;
        $arr_arg["mainpage"]=  LocationControler::getMainPage();
       
        $arr_arg["exit"]=  LocationControler::getExitPage();
       
        $arr_arg["selected_{$selected}"]= 'class="selected"';
        
        $this->page = new BaseView($arr_arg,$this->pattern);
        $this->page->deleteAllMarks();
    }
    
    
    
    public function buildForm()
    {
          
          return $this->page;
        
    }
    

//put your code here
}
