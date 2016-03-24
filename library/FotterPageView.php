<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class FotterPageView implements IFooterDiv {
     private $page;
    public function __construct() 
    {
        $this->page = new BaseView(array(),$_SERVER['DOCUMENT_ROOT']."/forms/fotterpageview.html");
        $this->page ->deleteAllMarks();
        
    }
    
    public function buildForm() {
        return $this->page->__ToString();
        
    }


//put your code here
}
