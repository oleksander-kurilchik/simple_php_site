<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserProfileEditView
 *
 * @author profesor
 */
class UserProfileEditView implements IMainPlaceDiv {
    private $arr;
    private $page;
    protected $pattern;
    








    public function  __construct($login,$arrmessage =null)
    {
        
        $this->initPattern();       
        
             mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select *from  table_users
where table_users.login = \"{$login}\" LIMIT 1; ");
 $row = mysql_fetch_array($result);
 $this->arr = $row;
 
 if(is_array($arrmessage))
 {
 $this->arr= $this->arr+ $arrmessage;
 }
 
 
 
 $this->page = new BaseView($this->arr,$this->pattern) ;
$this->page->deleteAllMarks();
    
       
    }
    protected function initPattern()
    {
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/userprofileeditview.html"; 
        
    }


    
    public function buildForm()
            {
        
        return $this->page->__ToString();
        
    }
    
       public function __ToString()
            {
        
        return $this->page->__ToString();
        
    }
    

//put your code here
}
