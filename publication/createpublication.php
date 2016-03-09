<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER['DOCUMENT_ROOT'] .'/SqlPostCreatot.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/PublicationsCreatorView.php';

$session = new SessionControler();
if ($session->is_Session() == false) {
    header("Location: " . LocationControler::getLoginPage());
    return;
}
$arg = array();
if (isset($_POST["header_of_pub"]) && isset($_POST["body_of_pub"])) {
    $arg["header_of_pub"] = $_POST["header_of_pub"];
    $arg["body_of_pub"] = $_POST["body_of_pub"];
}


$rightp = new UserRightPanel();




$pub_creat_view = new PublicationsCreatorView($arg);


$globaldiv = new GlobalDiv(/* $head, */ $rightp, $pub_creat_view /* , $foot */);
echo $globaldiv->buildForm();
