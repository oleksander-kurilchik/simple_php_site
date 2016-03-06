<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/ProfileRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserEditProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserProfileEditView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/PublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserInfoViewLite.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/CommentListViewExt.php';

$session = new SessionControler();

if ($session->is_Session() == false) {
    header("Location: " . LocationControler::getLoginPage());
    return;
}

if((isset( $_GET["mode"]))==false)
{
     header("Location: ".LocationControler::getProfillePage()."/index.php?mode=viewprofile"); 
   
    return;
}


$rightp_select =1;

$mainplace;

 if (!isset($_GET["page"])) {
        $page = 1;
    } else {
        $page = (int) $_GET["page"];
        if ($page <= 0) {
            $page = 1;
        }
    }



if ($_GET["mode"] == "viewprofile") {
    $mainplace = new UserInfoViewLite($_SESSION['login']);
    $rightp_select =1;
}
elseif ($_GET["mode"] == "publications") 
    {
   
$rightp_select =2;
    $mainplace = new PublicationListView($page, LocationControler::getProfillePage(). "?mode=publications&<\$page_number>", "and table_users.id_user={$_SESSION['id']} ");
}
elseif ($_GET["mode"] == "editprofile") {
    $rightp_select =4;
    $mainplace = new UserProfileEditView($_SESSION["login"]);
}
elseif ($_GET["mode"] == "comments") {
    $rightp_select =3;
    $mainplace = new CommentListViewExt($page,1,LocationControler::getProfillePage(). "?mode=comments&<\$page_number>"," and table_users.login=\"{$_SESSION["login"]}\" ");
}
else {
      header("Location: ".LocationControler::getProfillePage()."/index.php?mode=viewprofile"); 
   
    return;

}


$rightp = new ProfileRightPanel($rightp_select);

$globaldiv = new GlobalDiv(/* $head, */ $rightp, $mainplace /* , $foot */);
echo $globaldiv->buildForm();
?>
