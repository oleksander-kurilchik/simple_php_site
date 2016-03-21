<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LoginFormViewExt.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 
$session = new SessionControler();
if(SessionControler::is_Session() == true)
{
   
      $arr_arg = array("message" => "Ви вже залогінилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    
}

print_r($_POST);
$form = new LoginFormViewExt($_POST);
if($form->isValid())
{
   $form->enter();
   $arr_arg = array("message" => "Ви Успішно залогінилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    
    
}


  $form->enter();
   $arr_arg = array("message" => $form,
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;




?>