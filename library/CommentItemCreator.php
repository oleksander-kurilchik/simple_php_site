<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentViewItem.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentViewItemExtend.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentItemCreator
 *
 * @author profesor
 */
class CommentItemCreator {
    private $type=0;
    public function __construct($type=0)
    {
        $this->type=$type;
        
    }
    
    public function CreateCommentItem($data_comment,$is_action=false )
    {
        $item; 
        switch ( $this->type)
        {
            case 1:
            {
                    $item=   new CommentViewItemExtend($data_comment, $is_action); 
            }
            break;
        default :
        {
            $item=     new CommentViewItem($data_comment, $is_action); 
           
        }
        break;
        }
        
        return  $item;  
    }
    
    //put your code here
}



?>