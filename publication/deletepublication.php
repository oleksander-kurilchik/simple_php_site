<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/library/BaseView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/library/LocationControler.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';

$session = new SessionControler();

if ($session->is_Session() == false) {

    $arr_arg = array("message" => "Ви не увыйшли, будьласка залогіньтесь",
        "address_redirect" => LocationControler::getLoginPage(), "text_redirect" => "Перейти на сторінку входу");
    $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
    echo $page;
    return;
}




if ($_SERVER["REQUEST_METHOD"] == "GET") {


    if (!isset($_GET["id_publication"])) {
        $arr_arg = array("message" => "Неправильно передані параметри",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    }
    $id_publication = (int) $_GET["id_publication"];
    $id_user = (int) $_SESSION["id"];


    $queryDB = "select * from publications where id_public={$id_publication}  limit 1 ";
    $link = mysql_connect("localhost", "root", "1234");
    mysql_select_db("my_first_site", $link);
    $result = mysql_query($queryDB, $link);
   
    $row = mysql_fetch_array($result);
    if (!($row["id_user"]==$_SESSION["id"]||SessionControler::isAdmin_current()==true)) {
        $arr_arg = array("message" => "Ви не можете видалити Публікацію",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    } 
    elseif ($row["id_user"]==$_SESSION["id"]||SessionControler::isAdmin_current()==true)
        {
                $arg_form = array("header_of_pub"=>$row["header_of_pub"],"id_publication"=>$row["id_public"],"action"=>  LocationControler::getDeletePublicationPage());
                
                $form_delete = new BaseView($arg_form,$_SERVER['DOCUMENT_ROOT']."/forms/deletepublicationview.html" );
        
        
        $arr_arg = array("message" => $form_delete,
            "address_redirect" => $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
        
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    print_r($_POST);
} 
else {
    
}
?>