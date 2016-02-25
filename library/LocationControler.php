<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocationControler
 *
 * @author profesor
 */
class LocationControler {
    public static function getMainPage()
    {
        return "http://server3";
    }
     public static function getRegistrationPage()
    {
         return self::getMainPage()."/registration.php/";
        
    }
    public static function getLoginPage()
    {
         return self::getMainPage()."/login.php";
        
    }
     public static function getProfillePage()
    {
        return self::getMainPage()."/profile";          
    }
     public static function getPostPage()
    {
        return self::getMainPage()."/post.php";          
    }
     public static function getAdminPage()
    {
        return self::getMainPage()."/admin";          
    }
     public static function getAdminUsersPage()
    {
        return self::getMainPage()."/admin/user/userinfo.php";          
    }
    public static function getAdminPublicationPage()
    {
        return self::getMainPage()."/admin/publication";          
    }
      public static function getExitPage()
    {
        return self::getMainPage()."/exit.php";          
    }
      public static function getPublicationPage()
    {
        return self::getMainPage()."/viewpublic/";          
    }
    //put your code here
}
