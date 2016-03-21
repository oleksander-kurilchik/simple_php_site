<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class UserProfileEditView implements IMainPlaceDiv {
    private $arr;
    private $page;
    protected $pattern;
    public function  __construct($login,$arrmessage =null)
    {
        
        $this->initPattern(); 
        
        $sql = new SqlManager();
        $sql->selectQuery("select *from  table_users
where table_users.login = \"{$login}\" LIMIT 1; ");
         $row = $sql->getRow(0);
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
