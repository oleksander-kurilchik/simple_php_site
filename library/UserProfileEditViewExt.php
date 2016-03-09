<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserProfileEditView.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserProfileEditView
 *
 * @author profesor
 */
class UserProfileEditViewExt extends UserProfileEditView {
   
    protected function initPattern()
    {
        $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/userprofileeditviewext.html"; 
        
    }


    

//put your code here
}
