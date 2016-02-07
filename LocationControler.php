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
     public static function getUsersPage()
    {
        return self::getMainPage()."/admin/users.php";          
    }
      public static function getExitPage()
    {
        return self::getMainPage()."/exit.php";          
    }
    //put your code here
}
