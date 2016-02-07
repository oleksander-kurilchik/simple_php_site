<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PublicationView
 *
 * @author profesor
 */
class PublicationView implements IMainPlaceDiv {
    private $f_editable = false;
    private $pattern;
     public $arr_data;
    
    public function __construct ($data)
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/publicationview.html";
       $this->arr_data = $data;
        
    }
    
    public function buildForm()
    {
            
        
          $page =  file_get_contents($this->pattern);
          
         
          $page =  preg_replace('|{\$id_publication}|im',  $this->arr_data["id_public"],  $page);
          $page =  preg_replace('|{\$header}|im', $this->arr_data["header_of_pub"],  $page);
          $page =  preg_replace('|{\$publicationbody}|im', $this->arr_data["body_of_pub"],  $page);
          $page =  preg_replace('|{\$dateofpublication}|im',  $this->arr_data["date_of_creation"],  $page);
          $page =  preg_replace('|{\$dateoflastedit}|im', $this->arr_data["date_of_last_edit"],  $page);
          $page =  preg_replace('|{\$user}|im', $this->arr_data["login"],  $page);
          $page =  preg_replace('|{\$editable}|im',"sdjf kjdkjhdfhkjv hkfj",  $page);
          return $page;
        
        
        
        
        
    }
     public function setPublicationEditable( $flag)
    {
         if($flag ===true)
         {$this->f_editable =true;     }
 else {$this->f_editable =false;  }
    }
    

//put your code here
}
