<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GuestRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationListView.php';

$session = new SessionControler();

$rightp;


if ($session->is_Session() == false) {
    $rightp = new GuestRightPanel();
} else {
    $rightp = new UserRightPanel();
}



$globaldiv = new GlobalDiv(/* $head, */ $rightp , new PublicationListView (1)/*, $foot */);



echo $globaldiv->buildForm();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>