<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserInfoView.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfoView
 *
 * @author profesor
 */
class UserInfoViewLite extends UserInfoView
{
  
    protected function  initPattern()
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/user/userinfoviewlite.html"; 
    }


   

//put your code here
}
