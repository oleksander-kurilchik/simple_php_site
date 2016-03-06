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
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentListViewExt.php';


$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}
if((isset( $_GET["mode"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."/index.php?mode=userlisl"); 
   
    return;
}


$rightp_selected=1;
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



if($_GET["mode"] =="users")
{
    $rightp_selected=1;
    $mainplace = new UserListView($page, LocationControler::getMainPage(). "/admin/index.php?mode=userlisl&<\$page_number>");
}
elseif ($_GET["mode"] =="publications")
{
    $rightp_selected=2;
    $mainplace  =  new PublicationListView ($page, LocationControler::getAdminPage()."?mode=publications&<\$page_number>");
    

}
elseif ($_GET["mode"] =="comments")
{
    $rightp_selected=3;
    $mainplace = new CommentListViewExt ($page,1,LocationControler::getAdminPage()."?mode=comments&<\$page_number>"," order by comments_of_pub.id_comment ");
}
 else 
{
        header("Location: ".LocationControler::getAdminPage()."?mode=users"); 
   
    return;

}


$rightp = new AdminRightPanel($rightp_selected);

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();














?>