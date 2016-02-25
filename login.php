<?php

require_once './loginview.php';
require_once './sqlregvalidator.php';
require_once './reg_validador.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
$session = new SessionControler();
if($session->is_Session() == true)
{
    header("Location: ".LocationControler::getMainPage());
    return;
}


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
     $session->setLogin($_POST["login"]);
     $session->setAdmission(SqlRegValidator::getAdmision($_POST["login"]));
      $session->setId(SqlRegValidator::getId($_POST["login"]));
      header("Location: ".LocationControler::getMainPage());
       
       return;
    }
} 


    echo $view->buildView();


?>