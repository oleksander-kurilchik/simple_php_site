<?php

require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminCommentsListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminPublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationListView.php';


$rightp_selected=1;
$mainplace;
$page;
 if (!isset($_GET["page"])) {
        $page = 1;
    } 
 else {
        $page = (int) $_GET["page"];
        if ($page <= 0) {
            $page = 1;
        }
    }


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}

if((isset($_GET["user"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."?mode=userlisl"); 
   
    return;
}




$rightp = new AdminRightPanel(2);
$mainplace;
$mainplace = new PublicationListView($page,LocationControler::getUserPublicationPage()."?user={$_GET["user"]}&<\$page_number>" ,"and table_users.login=\"{$_GET["user"]}\"");

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();






?>








