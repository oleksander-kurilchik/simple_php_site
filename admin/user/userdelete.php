<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/SqlManager.php';


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    
    
    $arr_arg = array("message" => "У вас немає прав тут знаходитися",
        "address_redirect" => LocationControler::getMainPage(),
        "text_redirect" => "Перейти на головну сторінку");
    $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT']."/forms/informpage.html");
    echo $page;
    return;
}

if((isset( $_REQUEST["id_user"]))==false)
{
    echo generateBasePage("Помилка при передачі параметрів ");
    return; 
  }
$id_user = (int) $_REQUEST["id_user"];
$sql = new SqlManager();
$sql->selectQuery("select * from table_users where id_user={$id_user} limit 1");
if($sql->getNumRow()!=1)
{
    echo generateBasePage("Користувача з даним id не існує ");
    return;
 }
$row = $sql->getRow(0);

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    $row["action"]=LocationControler::getMainPage().$_SERVER['PHP_SELF'];
    $form = new BaseView ($row ,$_SERVER['DOCUMENT_ROOT']."/forms/deleteuserview.html") ;
    
    echo generateBasePage($form);
     return;
    
    
    
}
elseif($_SERVER["REQUEST_METHOD"]=="POST")
{
    $sql->selectQuery("delete from table_users where id_user={$id_user} limit 1");
    
    echo generateBasePage("Користувача {$row["login"]} видалено ");
    return;
    
    
}
function generateBasePage($message)
{
    $arr_arg = array("message" => $message,
        "address_redirect" => LocationControler::getAdminPage()."?section=userlisl", "text_redirect" => "Повернутися в адмінську панель");
    $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
    return $page; 
}
/*




?>