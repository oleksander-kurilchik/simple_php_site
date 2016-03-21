<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

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