<?php
require_once '../library/UserPublicationView.php';
require_once '../library/LocationControler.php';
require_once '../library/SessionControler.php';
require_once '../library/ProfileRightPanel.php';
require_once '../library/UserProfileView.php';
require_once '../library/UserPublicationView.php';
require_once '../library/UserEditProfileView.php';
require_once '../library/GlobalDiv.php';

$session = new SessionControler();

if($session->is_Session() ==false)
{
    header("Location: ".LocationControler::getLoginPage());
    return;
}
$rightp;
$rightp = new ProfileRightPanel();
$mainplace;
if($_GET["mode"]=="viewprofile")
{
    $mainplace = new UserProfileView();
    $mainplace->login = $_SESSION['login'];
   
   
}
elseif ($_GET["mode"]=="publications")
{
     $mainplace = new UserPublicationView ();
      $mainplace->login = $_SESSION['login'];
}
elseif ($_GET["mode"]=="editprofile")
{
     $mainplace = new UserEditProfileView();
}

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();
?>
