<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfoView
 *
 * @author profesor
 */
class UserInfoView implements IMainPlaceDiv
{
    protected  $pattern;
    private $login;
    private $page;
    public function __construct ($login)
    {
                $this->initPattern();
                
                mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select *from  table_users
where table_users.login = \"{$login}\" LIMIT 1; ");
 $row = mysql_fetch_array($result);
 
         $id_user = $row["id_user"];
        $result = mysql_query("select count(*)from  publications where id_user={$id_user};");
           $row_c_p = mysql_fetch_array($result);
          $row["countpub"] = $row_c_p["count(*)"];
          
          
          $result = mysql_query("select count(*)from  comments_of_pub where id_user={$id_user};");
           $row_c_c = mysql_fetch_array($result);
             $row["countcomm"] = $row_c_c["count(*)"];
           /// potim pererobit
             $row["deleteaction"] =  LocationControler::getAdminPage()."/user/userdelete.php?id_user={$id_user}";
             $row["editaction"] = LocationControler::getAdminPage()."/user/useredit.php?id_user={$id_user}";
          
            
 $this->page = new BaseView($row,$this->pattern)    ;  
        
    }
    protected function  initPattern()
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/user/userinfoview.html"; 
    }


    public function buildForm() {
      
          return $this->page->__ToString();
    }

//put your code here
}
