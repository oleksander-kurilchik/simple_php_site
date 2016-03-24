<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';
$session = new SessionControler();
if(SessionControler::is_Session() == true)
{
   
      $arr_arg = array("message" => "Ви вже залогінилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        return;
    
}

$form = new LoginFormViewExt($_POST);
if($form->isValid())
{
   $form->enter();
   $arr_arg = array("message" => "Ви Успішно залогінилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        return;
    
    
}


  $form->enter();
   $arr_arg = array("message" => $form,
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        return;




?>