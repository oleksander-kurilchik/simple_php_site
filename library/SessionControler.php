<?php
/*
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/SqlRegValidator.php';
*/

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class SessionControler {
    public function __construct()
    {
         session_start();
    }
   static public function is_Session()
    {       
        if(isset($_SESSION['login']))    {
    return true;
    }
    return false;
}
 

static public  function setSessionLogin($login)
{
    $_SESSION['login'] = $login;
    $_SESSION['id'] = SqlRegValidator::getId($login);
    
}
static public  function getCurrentLogin()
{
    return $_SESSION['login'];
}
static public  function getCurrentId()
{
    return $_SESSION['id'];
}

static public function isAdmin()
{
    $sql = new SqlManager();
    $sql->selectQuery("select admission from table_users where login=\"{$_SESSION['login']}\"");
    $row = $sql->getRow(0); 
    if($row['admission']==="admin")
        return true;
    return false;
}



public function __destruct () 
    {
    
        
    }
    //put your code here
}
