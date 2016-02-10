<?php
//admin panel


require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminCommentsListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminPublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/AdminUsersListView.php';


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}
if((isset( $_GET["section"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."?section=userlisl"); 
   
    return;
}


$rightp;
$rightp = new AdminRightPanel();
$mainplace;

if($_GET["section"] =="userlisl")
{
    $mainplace = new AdminUsersListView();
}
elseif ($_GET["section"] =="publications")
{
    $mainplace  =new AdminPublicationListView();
    

}
elseif ($_GET["section"] =="comments")
{
    $mainplace = new AdminCommentsListView();
}
 else 
{
        header("Location: ".LocationControler::getAdminPage()."?section=userlisl"); 
   
    return;

}

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();














?>