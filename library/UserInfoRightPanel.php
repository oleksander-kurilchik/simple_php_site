<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


class UserInfoRightPanel implements IRightPanelDiv
{
     private $pattern ;
     private $page;
    public function __construct($login,$selected=0 ) 
    {
        $login_query = "&login={$login}";
        
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/userinforightpanel.html";
        $arr_arg["user"]=  LocationControler::getUserPage()."?mode=userinfo".$login_query ;
        $arr_arg["publications"]=  LocationControler::getUserPage()."?mode=publications" .$login_query;
        $arr_arg["comments"]=  LocationControler::getUserPage()."?mode=comments".$login_query ;
        $arr_arg["edituser"]=  LocationControler::getUserPage()."?mode=edituser".$login_query;
       
         $arr_arg["adminpage"]=  LocationControler::getAdminPage();
        $arr_arg["exit"]=  LocationControler::getExitPage();
        
          $arr_arg["login"]=$login;
       
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
