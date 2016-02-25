<?php

class BaseView   {
        private $pattern;
        private $page;
        /*
    
    private $f_editable = false;
    private $pattern;
     public $arr_data;
     public $create_comment = false;
     private $pattern_comment_form;
     private $pattern_comment_item;*/
     
     
    
    public function __construct ($data,$pattern)
    {
       $this->pattern = $pattern;
       
       $this->data_of_publication = $data;
       
       $this->page =  file_get_contents($this->pattern);
       
       foreach ($data as $key => $value)
       {
            $this->page =  preg_replace('|{\$'.$key.'}|im', $value,  $this->page);          
       }
     
       
       
        
    }
    
    public function __toString() {
        
        return  $this->page;
    }



//put your code here
}
