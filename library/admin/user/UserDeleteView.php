<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDeleteView
 *
 * @author profesor
 */
class UserDeleteView  implements IMainPlaceDiv
{
    private  $pattern;
    public $login;
    public function __construct ()
    {
     $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/user/userinfoview.html";
        
       
        
    }
    
    public function buildForm()
            {
         
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("delete from  table_users
where table_users.login = \"{$this->login}\" ; ");
        //$row=mysql_fetch_array($result);
       
        
        return "User Deleted.<a hreh\"http://server3/admin/?section=userlisl\" Will you come back </a>  ";
        
    }
}

