<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

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
class CommentViewItemExtend extends CommentViewItem
{
   protected function initPattern()
    {
          $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/commentitemextend.html";
    }
     
            
   
    //put your code here
}
