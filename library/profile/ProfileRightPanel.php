<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IRightPanelDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileRightPanel
 *
 * @author profesor
 */
class ProfileRightPanel implements IRightPanelDiv {
    
     private $pattern ;
     private $page;
    public function __construct($selected=1 ) 
    {
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/profilerightpanel.html";
        $arr_arg["profileinfo"]=  LocationControler::getProfillePage()."?mode=viewprofile" ;
        $arr_arg["publications"]=  LocationControler::getProfillePage()."?mode=publications" ;
        $arr_arg["comments"]=  LocationControler::getProfillePage()."?mode=comments" ;
        $arr_arg["editprofile"]=  LocationControler::getProfillePage()."?mode=editprofile" ;
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
}
