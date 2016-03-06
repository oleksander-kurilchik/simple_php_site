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
        return self::getMainPage()."/profile/index.php";          
    }
    public static function getProfilleFolder()
    {
        return self::getMainPage()."/profile/";          
    }
    
     public static function getPostPage()
    {
        return self::getMainPage()."/post.php";          
    }
     public static function getAdminPage()
    {
        return self::getMainPage()."/admin/index.php";          
    }
    public static function getAdminFolder()
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
        return self::getMainPage()."/viewpublic/index.php";          
    }
     public static function getUserPublicationPage()
    {
        return self::getAdminFolder()."/user/userpublications.php";          
    }
     public static function getUserCommentsPage()
    {
        return self::getAdminFolder()."/user/usercomments.php";          
    }
    
    
    
    
    
    
    
    
     public static function getActionCommentPage()
    {
        return self::getMainPage()."/comments/";          
    }
    //put your code here
    
    
    
    
     public static function getCreatingPublicationPage()
    {
        return self::getMainPage()."/publication/createpublication.php";          
    }
    
    
}
