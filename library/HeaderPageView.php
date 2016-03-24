<?php

class HeaderPageView implements IHeaderDIv {
    private $page;
    public function __construct() 
    {
        $arr_arg = array("main"=>  LocationControler::getMainPage());
        $this->page = new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/headerpageview.html");
        $this->page ->deleteAllMarks();
    }
    
    public function buildForm() {
        return $this->page->__ToString();
    }

//put your code here
}
