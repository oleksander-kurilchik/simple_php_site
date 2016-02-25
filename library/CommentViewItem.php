<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';


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
    private $pattern;
    private $pattern_action;
    private $is_action = false;
    private $data_comment;
    private $data_view;
  
     
            
    function __construct($data_comment,$is_action=false ) 
    {
        $this->data_comment = $data_comment;
        $this->is_action = $is_action;
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/commentitem.html";
        $this->pattern_action = $_SERVER['DOCUMENT_ROOT']."/forms/commentaction.html";
        
        
        $this->data_view =  file_get_contents($this->pattern);
        $data_view_action="";
        if($this->is_action ==true)
        {
            $data_view_action =  file_get_contents($this->pattern_action);
            $data_view_action =  preg_replace('|{\$action_comment}|im', LocationControler::getActionCommentPage()."deletecomment.php",  $data_view_action);
                       
        }
        
        $this->data_view =  preg_replace('|{\$action_comment}|im', $data_view_action,  $this->data_view);
        
        foreach ($this->data_comment as $key => $value)
        {           
             $this->data_view =  preg_replace('|{\$'.$key.'}|im', $value,  $this->data_view);
        }
        
        
        
        
    }
    
    function __ToString()
    {
        return $this->data_view;
        
    }
    //put your code here
}
