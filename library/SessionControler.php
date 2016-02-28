<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessoinControler
 *
 * @author profesor
 */
class SessionControler {
    public function __construct()
    {
         session_start();
    }
    public function is_Session()
    {       
        if(isset($_SESSION['login']))    {
    return true;
    }
    return false;
}
  static public function is_Session_static()
    {       
        if(isset($_SESSION['login']))    {
    return true;
    }
    return false;
}


public  function setLogin($login)
{
    $_SESSION['login'] = $login;
}
static public  function getCurrentLogin()
{
    return $_SESSION['login'];
}
static public  function getCurrentId()
{
    return $_SESSION['id'];
}



public  function setId($id)
{
    $_SESSION['id'] = $id;
}
public  function setAdmission($admission)
{
    $_SESSION['admission'] = $admission;
}

public function isAdmin()
{
    if($_SESSION['admission']==="admin")
        return true;
    return false;
}

static public function isAdmin_current()
{
    if($_SESSION['admission']==="admin")
        return true;
    return false;
}



public function __destruct () 
    {
        
    }
    //put your code here
}
