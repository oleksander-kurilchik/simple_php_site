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

$reg_form = new RegistrationView($_POST);
if($reg_form->isValid())
{
    $reg_form->registrationUser();
    $arr_arg = array("message" => "Вітаю! Ви зарееструвалися!!!",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        SessionControler::setSessionLogin($_POST["login"]);
        return;
    
}
 else {
     $arr_arg = array("message" => $reg_form->__toString(),
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        return;
    
}














?>