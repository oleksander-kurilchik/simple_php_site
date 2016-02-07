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

public  function setLogin($login)
{
    $_SESSION['login'] = $login;
}
public  function setId($id)
{
    $_SESSION['id'] = $id;
}
public  function setAdmission($admission)
{
    $_SESSION['admission'] = $admission;
}
    public function __destruct () 
    {
        
    }
    //put your code here
}
