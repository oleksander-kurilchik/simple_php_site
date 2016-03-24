<?php
/*
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GuestRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/library/SqlManager.php';
 * 
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';




$session = new SessionControler();


if($_GET["publication"]==NULL||(preg_match('|^[0-9]+$|', $_GET["publication"])==false))
{
  
   $arr_arg = array("message" => "Помилковий запит: не вказаний publication",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися в на головну сторінку");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ; 
}
$id_public = (int) $_GET["publication"];
$sql = new SqlManager();
$sql->selectQuery("select * from publications where id_public={$id_public} limit 1");
if($sql->getNumRow()==0)
{
     $arr_arg = array("message" => "Дана Публікація не існує",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися в на головну сторінку");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
    
}
$mainplace  = new PublicationView($_GET["publication"]);
///$mainplace->arr_comments_list = $arr_comments;

if($session->is_Session() ==false)
{
    $rightp = new GuestRightPanel();
    
}
else
 {
    
$rightp = new UserRightPanel();
 
}



$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();

?>