<?php

require_once './loginview.php';
require_once './sqlregvalidator.php';
require_once './reg_validador.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$view = new LoginView(); ///потом попраить код
$flag = true;
if (!empty($_POST)) {
    if (RegistrationValidator::isValidLogin($_POST["login"], $match) == true) {
        if (SqlRegValidator::isCheckLoginPasswod($_POST["login"], $_POST["password"])) {
            
        } else {
            $flag = false;
            $view->loginmessage = "Login or password invalid";
        }
    } else {
        $flag = false;
        $view->loginmessage = "Login incorect";
    }

    if ($flag == true) {
        echo 'Log in';
       echo "<H1>login and password corect</h1>";
       return;
    }
} 


    echo $view->buildView();


?>