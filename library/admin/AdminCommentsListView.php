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
class AdminCommentsListView implements IMainPlaceDiv {
     private $pattern;
    private $patternitem;
    
    
    public function __construct() 
    {
        
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/commentview.html";
         $this->patternitem  = $_SERVER['DOCUMENT_ROOT']."/forms/admin/commentviewitem.html";
    }
    
    public function buildForm() 
    {
        
        
        $user_query = $pub_query="";
        
    if(isset( $_GET["user"]))
    {
       $user_query  = " and table_users.login=\"". $_GET["user"]. "\" ";  
    }
    if(isset( $_GET["publication"]))
    {
       $pub_query  = " and comments_of_pub.id_publications=". $_GET["publication"]  ;  
    }
        
         mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select comments_of_pub.id_comment , table_users.login,"
                . "comments_of_pub.body_of_comment, comments_of_pub.datepub, comments_of_pub.id_publications"
                . " from comments_of_pub,table_users,publications "
                . " where comments_of_pub.id_user=table_users.id_user "
                . " and comments_of_pub.id_publications = publications.id_public  ".$user_query.$pub_query." order by id_comment");
        //$row=mysql_fetch_array($result);
        $commentitembase = file_get_contents($this->patternitem);
        
        print_r($result."<br>");
        
        $commentitemsresult = '';
        while ($row = mysql_fetch_array($result))
                {
            
            $commitem = $commentitembase;
            $commitem = preg_replace('|{\$id_comment}|im', $row["id_comment"], $commitem);
             $commitem = preg_replace('|{\$id_publication}|im', $row["id_publications"], $commitem);
             $commitem = preg_replace('|{\$login}|im', $row["login"], $commitem);
            $commitem = preg_replace('|{\$textcomment}|im', $row["body_of_comment"], $commitem);
            $commitem = preg_replace('|{\$dateofpublic}|im', $row["datepub"], $commitem); 
            $commitem = preg_replace('|{\$actiondeletecomment}|im',LocationControler::getAdminPage()."/deletecomment.php?id={$row["id_comment"]}", $commitem);
            $commentitemsresult = $commentitemsresult. $commitem;   
          

        }     
        
       
        $page =  file_get_contents($this->pattern);                 
        $page =  preg_replace('|{\$commentslist}|im',  $commentitemsresult,  $page);
        return $page;  
          
        
        
        
        
        
    }

//put your code here
}
