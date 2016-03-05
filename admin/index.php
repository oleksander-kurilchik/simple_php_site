<?php
//admin panel


require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminCommentsListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminPublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/admin/AdminUsersListView.php';




require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentListView.php';



$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}
if((isset( $_GET["section"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."/index.php?section=userlisl"); 
   
    return;
}


$rightp;
$rightp = new AdminRightPanel();
$mainplace;
 if (!isset($_GET["page"])) {
        $page = 1;
    } 
 else {
        $page = (int) $_GET["page"];
        if ($page <= 0) {
            $page = 1;
        }
    }



if($_GET["section"] =="userlisl")
{
    $mainplace = new UserListView($page, LocationControler::getMainPage(). "/admin/index.php?section=userlisl&<\$page_number>");
}
elseif ($_GET["section"] =="publications")
{
    $mainplace  =new AdminPublicationListView();
    

}
elseif ($_GET["section"] =="comments")
{
    $mainplace = new CommentListView(null,1);
}
 else 
{
        header("Location: ".LocationControler::getAdminPage()."?section=userlisl"); 
   
    return;

}

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();














?>