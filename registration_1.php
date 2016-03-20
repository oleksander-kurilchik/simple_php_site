<?php
require_once './registrationview.php';
require_once './reg_validador.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */echo "<pre>";
    print_r($_POST);
      echo "</pre>";
       $viev = new RegistrationView();
       $creator = new SqlUserCreator();
if(!empty($_POST))
{

    
    if(RegistrationValidator::isValidPostValue($_POST, $viev, $creator)==true)
    {
        $creator->createUser();
    }
 else {
       echo $viev->BuildForm();
    }
 
}
 else
{
    
    $viev = new RegistrationView();
echo $viev->BuildForm();
     
}










?>