<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

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
   
    $flag=true;
    if(RegistrationValidator::isValidLogin($this->arr_arg["login"])==true)
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