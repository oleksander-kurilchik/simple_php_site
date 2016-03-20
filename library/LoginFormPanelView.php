<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/RegistrationValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/SqlRegValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginFormPanelView
 *
 * @author profesor
 */
class LoginFormPanelView
{
    private $pattern;
    private $page;
    private $arr_arg;
    private $is_valid = false;
  public function __construct($arr_arg = null)
{
    initPatern ();
    if($arr_arg==null)
    { $this->arr_arg = array();
    
    }
    else
    {
      $this->validate()  ;
    }
    
    
    
    $this->arr_arg["action"] = LocationControler::getLoginPage();
    $this->arr_arg["registration"] = LocationControler::getRegistrationPage();
    
    $this->page = new BaseView($this->arr_arg,$this->pattern);
     $this->page->deleteAllMarks();
    
}
    
protected function initPatern ()
{
$this->pattern =$_SERVER['DOCUMENT_ROOT'] . "/forms/loginbaseview.html";;


} 
private function validate()
{
    $flag=true;
    if(RegistrationValidator::isValidLogin($this->arr_arg["login"]))
    {
        if(!SqlRegValidator::isCheckLoginPasswod($this->arr_arg["login"], $this->arr_arg["password"]))
        {    $flag=false;
        $this->arr_arg["login_m"]="Неправильний логін або пароль";  
        }
    }
    else{ $flag=false;
        $this->arr_arg["login_m"]="Логін меє неправильний формат"; }
    
    
    $this->is_valid = $flag;
    
}
public function enter() 
{
    if($this->is_valid==true)
    {
        
        
    }
    else {return false;}
        
        return $this->page;
}
public function isValid() 
 {
    return $this->is_valid;
}


public function __ToString() 
        {
    return $this->page;
}




        }