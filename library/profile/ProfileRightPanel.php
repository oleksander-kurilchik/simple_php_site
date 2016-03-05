<?php
require_once '../interfaces/IRightPanelDiv.php';
require_once '../library/GlobalDiv.php';



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileRightPanel
 *
 * @author profesor
 */
class ProfileRightPanel implements IRightPanelDiv {
    
     private $pattern ;
    public function __construct() 
    {
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/profilerightpanel.html";
        
        
    }
    
    
    public function buildForm() 
    {
          $page =  file_get_contents($this->pattern);
          $page =  preg_replace('|{\$profileinfo}|im',  $_SERVER['PHP_SELF']."?mode=viewprofile ",  $page);
         
          $page =  preg_replace('|{\$mypublications}|im',  $_SERVER['PHP_SELF']."?mode=publications" ,  $page);
          $page =  preg_replace('|{\$editprifile}|im', $_SERVER['PHP_SELF']."?mode=editprofile",  $page);
          $page =  preg_replace('|{\$passwordmessage}|im', NULL,  $page);
         
          return $page;
          return $page;
        
    }
}
