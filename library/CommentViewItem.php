<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentViewItem
 *
 * @author profesor
 */
class CommentViewItem 
{
    protected $pattern;
    private $pattern_action;
    private $is_action = false;
    private $data_comment;
    private $data_view;
  
     
            
    function __construct($data_comment,$is_action=false ) 
    {
        $this->initPattern();
        $this->data_comment = $data_comment;
        $this->is_action = $is_action;
       
        $this->pattern_action = $_SERVER['DOCUMENT_ROOT']."/forms/commentaction.html";
        
        
       // $this->data_view =  file_get_contents($this->pattern);
        $data_view_action="";
        if($this->is_action ==true)
        {
            $data_view_action  = new BaseView(array("action_comment"=>LocationControler::getActionCommentPage()."deletecomment.php","id_comment"=>$this->data_comment["id_comment"]),$this->pattern_action);
                        
        }
        
             
        $this->data_comment["action_comment"]=$data_view_action;
         $this->data_comment["address_publications"]=  LocationControler::getPublicationPage()."?publication=".$this->data_comment["id_publications"]."";
        
        
        $this->data_view = new BaseView($this->data_comment,$this->pattern);
        
        
        
        
    }
    protected function initPattern()
    {
          $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/commentitem.html";
    }
            
    function __ToString()
    {
        return $this->data_view->__ToString();
        
    }
    //put your code here
}
