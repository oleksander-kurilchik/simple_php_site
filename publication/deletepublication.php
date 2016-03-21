<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';
$session = new SessionControler();


print_r($_REQUEST);
print_r($_SERVER["REQUEST_METHOD"] );


if (SessionControler::is_Session() == false) {

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
    $sql = new SqlManager();
    $sql->selectQuery($queryDB);    
    $rows_count = $sql->getNumRow();

    if ($rows_count == 1 || SessionControler::isAdmin()) {
        return true;
    }
    return false;
}

function makeForm($id) {
    $queryDB = "select * from publications where id_public={$id}  limit 1 ";
    $sql = new SqlManager();
    $sql->selectQuery($queryDB); 
    $row = $sql->getRow(0);
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
    $sql = new SqlManager();
    $sql->selectQuery($queryDB);
}





?>