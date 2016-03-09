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
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserInfoRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserInfoView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserProfileEditViewExt.php';
$session = new SessionControler();

if(($session->is_Session() ==true&&$_SESSION["admission"]=="admin")==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}


if(isset( $_GET["login"])==false||isset( $_GET["mode"])==false)
{
     header("Location: ".LocationControler::getAdminPage()."/index.php?mode=users"); 
   
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

    $login= $_GET["login"];
    
$login_query = "&login={$login}";

if($_GET["mode"] =="userinfo")
{
   
     $arg= array("listpub"=>  LocationControler::getUserPage()."?mode=publications&login={$login}" ,
         "listcomm"=>LocationControler::getUserPage()."?mode=comments&login={$login}");    
    
    $rightp_selected=1;
$mainplace = new UserInfoView($_GET["login"],$arg);
}
elseif ($_GET["mode"] =="publications")
{
    $rightp_selected=2;
    $mainplace  =  new PublicationListView ($page, LocationControler::getUserPage()."?mode=publications&<\$page_number>".$login_query," and table_users.login=\"{$login}\" ");
}
elseif ($_GET["mode"] =="comments")
{
    $rightp_selected=3;
    $mainplace = new CommentListViewExt ($page,1,LocationControler::getUserPage()."?mode=comments&<\$page_number>".$login_query," and table_users.login=\"{$login}\"  order by comments_of_pub.id_comment ");
}
elseif ($_GET["mode"] =="edituser")
{
    $rightp_selected=4;
    $mainplace = new UserProfileEditViewExt($login);
}
 else 
{
       
     header("Location: ".LocationControler::getAdminPage()."/index.php?mode=users");    
    return;

}


$rightp = new UserInfoRightPanel ($_GET["login"], $rightp_selected);

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();














?>