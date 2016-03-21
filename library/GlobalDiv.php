<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author profesor
 */
class GlobalDiv {
    //put your code here
  private $header;
  private $rightpanel;
  private $mainplace;
  private $footer;
  private $pattern;
    public function __construct(/*IHeaderDIv $head,*/  IRightPanelDiv $rightp ,
                                    IMainPlaceDiv $main =NULL/*,  IFooterDiv */)
    {
        //$this->header = $head; 
        $this->rightpanel = $rightp; 
       $this->mainplace = $main;
       // $this->footer = $foot; 
       
       
      $this->pattern= $_SERVER['DOCUMENT_ROOT'].'/forms/basepage.html';
               
    }
    public function buildForm() 
    {
         $page =  file_get_contents($this->pattern);
        // $page =  preg_replace('|{\{$header}}|im', $this->header->buildForm(),  $page);
         $page =  preg_replace('|{\$rightpanel}|im', $this->rightpanel->buildForm(),  $page);
       if  ( $this->mainplace != null)
        {
         $page =  preg_replace('|{\$mainplace}|im', $this->mainplace->buildForm(),  $page);
        }
        // $page =  preg_replace('|{\{$footer}}|im', $this->footer->buildForm(),  $page);
         
          return $page;
        
    }
    
}
