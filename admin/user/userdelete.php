<?php
/*
require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminCommentsListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminPublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/user/UserDeleteView.php';


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}

if((isset( $_GET["id_user"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."?section=userlisl"); 
   
    return;
}




$rightp = new AdminRightPanel();
$mainplace;
$mainplace = new UserDeleteView();
$mainplace->login = $_GET["login"];

$globaldiv = new GlobalDiv($rightp, $mainplace );
echo $globaldiv->buildForm();


*/



?>