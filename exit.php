<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

session_start();
unset($_SESSION);
session_destroy();
  $arr_arg = array("message" => "Ви вийшли",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new InformPageView($arr_arg);
        echo $page;
        return;
?>
