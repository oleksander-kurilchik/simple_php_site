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
class AdminPublicationListView implements IMainPlaceDiv {
    private $pattern;
    private $patternitem;
    
    
    public function __construct() 
    {
        
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/adminpublicationlist.html";
         $this->patternitem  = $_SERVER['DOCUMENT_ROOT']."/forms/admin/adminpublicationlistitem.html";
    }
    
    
    public function buildForm() 
    {
        
        $lllll="" ;
    if(isset( $_GET["user"]))
    {
       $lllll  = " and table_users.login=\"". $_GET["user"]. "\"";  
    }
        
         mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select * from publications,table_users where publications.id_user=table_users.id_user ".$lllll);
        //$row=mysql_fetch_array($result);
        $pibitembase = file_get_contents($this->patternitem);
        
       
        
        $publicitemsresult = '';
        while ($row = mysql_fetch_array($result))
                {
            $pibitem = $pibitembase;
            $pibitem = preg_replace('|{\$header}|im', $row["header_of_pub"], $pibitem);
             $pibitem = preg_replace('|{\$publicationbody}|im', mb_strimwidth($row["body_of_pub"], 0, 100, "..."), $pibitem);
            $pibitem = preg_replace('|{\$dateofpubliucation}|im', $row["date_of_creation"], $pibitem);
            $pibitem = preg_replace('|{\$user}|im', $row["login"], $pibitem); 
            $pibitem = preg_replace('|{\$pub_addres}|im',LocationControler::getAdminPublicationPage()."/?id={$row["id_public"]}", $pibitem);
            $publicitemsresult = $publicitemsresult. $pibitem;   
          

        }     
        
       
        $page =  file_get_contents($this->pattern);                 
        $page =  preg_replace('|{\$publicationlist}|im',  $publicitemsresult,  $page);
        return $page;  
          
        
        
        
        
        
        
    }

//put your code here
}
