<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class InformPageView {
    private $page;
    private $page_arg;
   
    public function __construct($arr_arg) {
        $foot = new FotterPageView();
        $head = new HeaderPageView();
        $this->page_arg["header"]=$head->buildForm(); 
         $this->page_arg["footer"]=$foot->buildForm(); 
       $this->page_arg+=$arr_arg;
       $this->page = new BaseView( $this->page_arg,$_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
       $this->page->deleteAllMarks();
       
       
    }
    
     public function __toString() {
        
        return  $this->page->__toString();
    }
    //put your code here
}
