<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


class SqlRegValidator {
    //put your code here
    public static function isLoginExists(  $login)
    {
        $sql = new SqlManager();
        $sql->selectQuery("select login from  table_users where login=\"{$login}\" limit 1  ");
        
        if($sql->getNumRow()==1)
        {
            return true;
            
        }
        return false;
        
    }
     public static function isEmailExists(  $email)
    {
         
         $sql = new SqlManager();
        $sql->selectQuery("select email from  table_users where email=\"{$email}\" limit 1  ");
        if($sql->getNumRow()==1)
        {
            return true;
            
        }
        return false;
        
    }
     public static function isCheckLoginPasswod(  $login ,$password )
    {
         $password = sha1($password);
         
          $sql = new SqlManager();
        $sql->selectQuery("select hesh_password from  table_users where login=\"{$login}\" and hesh_password=\"{$password}\"  limit 1  ");
        if( $sql->getNumRow()==1)
        {
            return true;
            
        }
        return false;
        
    }
     public static function getAdmision(  $login )
    {        
       
       
         $sql = new SqlManager();
        $sql->selectQuery("select admission from  table_users where login=\"{$login}\"   limit 1  ");
        $row=$sql->getRow(0);
        return  $row["admission"];
        
    }
     public static function getId(  $login )
    {
       
         
           $sql = new SqlManager();
        $sql->selectQuery("select id_user from  table_users where login=\"{$login}\"   limit 1  ");
        $row=$sql->getRow(0);
        return  $row["id_user"];
              
    }
}
