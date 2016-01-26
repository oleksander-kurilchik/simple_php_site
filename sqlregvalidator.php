<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlRegValidator
 *
 * @author profesor
 */
class SqlRegValidator {
    //put your code here
    public static function isLoginExists(  $login)
    {
         mysql_connect("127.0.0.1","root","1234");
         mysql_select_db("my_first_site");
       $result = mysql_query("select login from  table_users where login=\"{$login}\" limit 1  ") or die(mysql_error());
        if(mysql_num_rows($result)==1)
        {
            return true;
            
        }
        return false;
        
    }
     public static function isEmailExists(  $email)
    {
         
        mysql_connect("localhost","root","1234");
        mysql_select_db("my_first_site");
       $result = mysql_query("select email from  table_users where email=\"{$email}\" limit 1  ");
        if( mysql_num_rows($result)==1)
        {
            return true;
            
        }
        return false;
        
    }
     public static function isCheckLoginPasswod(  $login ,$password )
    {
         $password = sha1($password);
        mysql_connect("localhost","root","1234");
        mysql_select_db("my_first_site");
       $result = mysql_query("select hesh_password from  table_users where login=\"{$login}\" and hesh_password=\"{$password}\"  limit 1  ");
        if( mysql_num_rows($result)==1)
        {
            return true;
            
        }
        return false;
        
    }
}
