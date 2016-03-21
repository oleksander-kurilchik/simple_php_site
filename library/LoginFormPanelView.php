<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/RegistrationValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/SqlRegValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';


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
    protected $pattern;
    private $page;
    private $arr_arg;
    private $is_valid = false;
  public function __construct($arr_arg = null)
{
    $this->initPatern();
    if($arr_arg==null)
    { $this->arr_arg = array();
    
    }
    else
    {
        $this->arr_arg = $arr_arg;
      $this->validate()  ;
    }
    
    
    
    $this->arr_arg["action"] = LocationControler::getLoginPage();
    $this->arr_arg["registration"] = LocationControler::getRegistrationPage();
  
    $this->page = new BaseView($this->arr_arg,$this->pattern);
     $this->page->deleteAllMarks();
   
    
}
    
protected function initPatern()
{
$this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/loginbaseview.html";;
} 
private function validate()
{
    print_r("sddddddddddddd---------".$this->arr_arg["password"]."8888");
     print_r($this->arr_arg);
     print_r("999dddddddddddd---------".$this->arr_arg["password"]."==============");
    
    $flag=true;
    if(RegistrationValidator::isValidLogin($this->arr_arg["login"])==false)
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
        SessionControler::setSessionLogin($this->arr_arg["login"]);
        
        
        
        return true;
        
    }
    else {return false;}
        
        
}
public function isValid() 
 {
    return $this->is_valid;
}


public function __ToString() 
        {
    return $this->page->__ToString();
}




        }