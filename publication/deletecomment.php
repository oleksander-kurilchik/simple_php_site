<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


$session = new SessionControler();
echo "<pre>";
print_r($_POST);

if (SessionControler::is_Session() == false) {
       $arr_arg = array("message" => "Ви не залоіынилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
}
if(isset($_POST["id_comment"]))
{
   $id_comment = (int)  $_POST["id_comment"];
   $queryDB = "select * from comments_of_pub where id_comment={$id_comment} and id_user={$_SESSION["id"]}   limit 1 ";
  
   $sql = new SqlManager();
   $sql->selectQuery($queryDB);
   
    
    
    $row_count = $sql->getNumRow();
    if($row_count!=0||SessionControler::isAdmin()==true)
    {
         $queryDB = "delete from comments_of_pub where id_comment={$id_comment}   limit 1 ";
         $sql->selectQuery($queryDB);
        
         $arr_arg = array("message" => "Комментар видаленно ",
            "address_redirect" =>  $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку  сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
        
        
        
        
        
    }
    $arr_arg = array("message" => "Помилка  ",
            "address_redirect" =>  $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку  сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    
    
    
    
}







?>