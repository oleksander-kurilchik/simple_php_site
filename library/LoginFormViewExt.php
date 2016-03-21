<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LoginFormPanelView.php';



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginFormPanelView
 *
 * @author profesor
 */
class LoginFormViewExt extends LoginFormPanelView
{
   
protected function initPatern ()
{
$this->pattern =$_SERVER['DOCUMENT_ROOT'] . "/forms/loginbaseviewext.html";;
} 
}