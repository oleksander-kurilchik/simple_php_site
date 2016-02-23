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
     public $create_comment = false;
     private $pattern_comment_form;
     private $pattern_comment_item;
     private $pattern_comment_view;
     public $arr_comments_list;
    
    public function __construct ($data)
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/publicationview.html";
         $this->pattern_comment_form = $_SERVER['DOCUMENT_ROOT']."/forms/commentform.html";
           $this->pattern_comment_item = $_SERVER['DOCUMENT_ROOT']."/forms/commentitem.html";
           $this->pattern_comment_view = $_SERVER['DOCUMENT_ROOT']."/forms/commentsview.html";
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
         
          
          $commentform =null;   
            if($this->create_comment == true)
            {
            $commentform  =  file_get_contents($this->pattern_comment_form);
            }
            
            $commentsview =  file_get_contents($this->pattern_comment_view);
          
           $commentitembase=  file_get_contents($this->pattern_comment_item);
           
          // print_r($this->arr_comments_list);
           $commentitemlist='';
           
            for($i=0;$i<count($this->arr_comments_list);$i++)
            {
                 $commentitem =   $commentitembase;
                 $commentitem =  preg_replace('|{\$username}|im',$this->arr_comments_list[$i]['login'],  $commentitem);
                 $commentitem =  preg_replace('|{\$commentbody}|im',$this->arr_comments_list[$i]['body_of_comment'],  $commentitem);
                 $commentitem =  preg_replace('|{\$datetimecomment}|im',$this->arr_comments_list[$i]['datepub'], $commentitem);
                $commentitemlist = $commentitemlist.$commentitem;
            }
            
              $commentform =  preg_replace('|{\$action}|im',"http://server3/viewpublic/addcomments.php",  $commentform);
              $commentform =  preg_replace('|{\$id_publication}|im',$_GET["publication"],  $commentform);
            
          
              $commentsview =  preg_replace('|{\$commentsform}|im',$commentform,  $commentsview);
             $commentsview =  preg_replace('|{\$commentslist}|im',$commentitemlist,  $commentsview);
             
             $page =  preg_replace('|{\$comments}|im',$commentsview,  $page);
            
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
