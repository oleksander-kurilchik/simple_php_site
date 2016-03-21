<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserInfoView.php';


class UserInfoViewLite extends UserInfoView
{
  
    protected function  initPattern()
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/user/userinfoviewlite.html"; 
    }

}
