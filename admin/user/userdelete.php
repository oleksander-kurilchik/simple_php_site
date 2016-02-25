<?php

require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminCommentsListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminPublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/user/UserDeleteView.php';


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}

if((isset( $_GET["login"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."?section=userlisl"); 
   
    return;
}




$rightp = new AdminRightPanel();
$mainplace;
$mainplace = new UserDeleteView();
$mainplace->login = $_GET["login"];

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();






?>