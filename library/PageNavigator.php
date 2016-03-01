<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PublicationNavigator
 *
 * @author profesor
 */
class PageNavigator
{private $page;

    
    public function __construct($currentpage,$prevpage,$nextpage) 
    { 
        $btn_ptn = $_SERVER['DOCUMENT_ROOT']."/forms/navigation/PublicationNavigatorButton.html";
        $btni_ptn = $_SERVER['DOCUMENT_ROOT']."/forms/navigation/PublicationNavigatorButtonInactive.html";
        
        $current=$next=$prev="";
        if($currentpage!=0)
        {
            $current = new BaseView ($currentpage , $btni_ptn);
            
        }
         if($prevpage!=0)
        {
            $prev = new BaseView ($prevpage,$btn_ptn);
        }
         if($nextpage!=0)
        {
            $next = new BaseView ($nextpage,$btn_ptn);
        }
       $this->page= new BaseView(array("current"=>$current,"prev"=>$prev,"next"=>$next),
               $_SERVER['DOCUMENT_ROOT']."/forms/navigation/PublicationNavigatorView.html" );
       
        
        
        
    }
    public function __toString() {
        return  $this->page->__toString() ;  ;
    }
            
}
