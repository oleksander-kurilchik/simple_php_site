<?php

require_once './SessionControler.php';
require_once './GuestRightPanel.php';
require_once './UserRightPanel.php';
require_once './library/GlobalDiv.php';

$session = new SessionControler();

$rightp;


if ($session->is_Session() == false) {
    $rightp = new GuestRightPanel();
} else {
    $rightp = new UserRightPanel();
}



$globaldiv = new GlobalDiv(/* $head, */ $rightp/* , $main, $foot */);



echo $globaldiv->buildForm();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>