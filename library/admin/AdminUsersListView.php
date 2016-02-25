<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersListView
 *
 * @author profesor
 */
class AdminUsersListView implements IMainPlaceDiv {
    private $pattern;
    private $patternitem;
    public function __construct()
    {
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/adminuserlist.html";
         $this->patternitem  = $_SERVER['DOCUMENT_ROOT']."/forms//admin/adminuserlistitem.html";
        
    }
    public function buildForm() 
    {
        
        
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select * from  table_users");
        //$row=mysql_fetch_array($result);
        $pibitembase = file_get_contents($this->patternitem);
        $publicitemsresult = '';
        while ($row = mysql_fetch_array($result))
                {
            $pibitem = $pibitembase;
            $pibitem = preg_replace('|{\$login}|im', $row["login"], $pibitem);
             $pibitem = preg_replace('|{\$email}|im', $row["email"], $pibitem);
            $pibitem = preg_replace('|{\$admission}|im', $row["admission"], $pibitem);
            //$pibitem = preg_replace('|{\$dateofcreation}|im', $row["date_of_creation"], $pibitem); dorabotat
            $pibitem = preg_replace('|{\$useraddr}|im',LocationControler::getAdminUsersPage()."?login={$row["login"]}", $pibitem);
            $publicitemsresult = $publicitemsresult. $pibitem;
            
          

        }
        
          
        
        
        $page =  file_get_contents($this->pattern);
          
         
          $page =  preg_replace('|{\$userlist}|im',  $publicitemsresult,  $page);
          
          
          
          return $page;
        
        
        
        
                
        
    }

//put your code here
}

/*
  
  $result = mysql_query("select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login,table_users.admission
from  table_users, publications
where publications.id_user =table_users.id_user and publications.id_public ={$_GET["publication"]} LIMIT 1; ");
  
  
    
 * 
 */

?>
