<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/library/BaseView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/library/LocationControler.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';

$session = new SessionControler();


print_r($_REQUEST);
print_r($_SERVER["REQUEST_METHOD"] );


if ($session->is_Session() == false) {

    $arr_arg = array("message" => "Ви не увыйшли, будьласка залогіньтесь",
        "address_redirect" => LocationControler::getLoginPage(), "text_redirect" => "Перейти на сторінку входу");
    $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
    echo $page;
    return;
}


 

if ($_SERVER["REQUEST_METHOD"] == "GET") {


    if (!isset($_GET["id_publication"])) {
        echo makeRedirectView("Неправильно передані параметри");
        return;
    }
    $id_publication = (int) $_GET["id_publication"];
    if (checkAccess($id_publication) == false)
        {  
        echo makeRedirectView("Ви не можете видалити Публікацію");
        return;
    } 
    elseif (checkAccess($id_publication) == true) 
        {
        
        echo makeForm($id_publication);
        return;
    }
} 
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_publication"]))
 {
    $id_publication = (int) $_POST["id_publication"];
    if(checkAccess($id_publication) == true)
    {       
        deletePublication($id_publication);
         echo makeRedirectView("Публікація видаленно");
           return;
    }
 else {
     echo makeRedirectView("Ви не можете видалити цю публікацію");
       return;
        
    }  
}
else 
{
     echo makeRedirectView("Неправильно передані параметри");
        return;
    
}



///////////////////////////////////////////////////////////////////////////////////////
function checkAccess($id) {
    $queryDB = "select * from publications where id_public={$id} and id_user={$_SESSION["id"]}  limit 1 ";
    $link = mysql_connect("localhost", "root", "1234");
    mysql_select_db("my_first_site", $link);
    $result = mysql_query($queryDB, $link);
    $rows_count = mysql_num_rows($result);

    if ($rows_count == 1 || SessionControler::isAdmin_current()) {
        return true;
    }
    return false;

    mysql_close($link);
}

function makeForm($id) {
    $queryDB = "select * from publications where id_public={$id}  limit 1 ";
    $link = mysql_connect("localhost", "root", "1234");
    mysql_select_db("my_first_site", $link);
    $result = mysql_query($queryDB, $link);

    $row = mysql_fetch_array($result);
    mysql_close($link);

    $arg_form = array("header_of_pub" => $row["header_of_pub"], "id_publication" => $row["id_public"], "action" => LocationControler::getDeletePublicationPage());
    $form_delete = new BaseView($arg_form, $_SERVER['DOCUMENT_ROOT'] . "/forms/deletepublicationview.html");
    $arr_arg = array("message" => $form_delete,
        "address_redirect" => $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку");
    $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
    
    
    return $page;
    
}

function makeRedirectView($message)
{
    $arr_arg = array("message" => $message,
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        return $page;
       
}

function deletePublication($id)
{
    $queryDB = "delete from publications where id_public={$id}  limit 1 ";
    $link = mysql_connect("localhost", "root", "1234");
    mysql_select_db("my_first_site", $link);
    $result = mysql_query($queryDB, $link);
    mysql_close($link);

   
}





?>