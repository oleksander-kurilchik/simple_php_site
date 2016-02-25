<?php

require_once './SqlPostCreatot.php';
require_once './SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/addmaterialview.php';

$session = new SessionControler();
if ($session->is_Session() == false) {
    header("Location: " . LocationControler::getLoginPage());
    return;
}
include_once './addmaterialview.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($session->is_Session() == false) {
    header("Location: " . LocationControler::getLoginPage());
    return;
}




$view = new AddMaterialView();
$flag = true;
if (!empty($_POST)) {

    if (strlen($_POST["header"]) < 10) {
        $view->headermessage = " header so small";
        $flag = false;
    } else {
        $view->header = $_POST["header"];
    }
    if (strlen($_POST["material"]) < 100) {
        $view->materialmessage = " material so small";
        $flag = false;
    } else {
        $view->material = $_POST["material"];
    }
    if ($flag == true) {


        $post = new SqlPostCreatot();
        $post->header = htmlspecialchars($_POST["header"], ENT_QUOTES);
        ;
        $post->post_data = htmlspecialchars($_POST["material"], ENT_QUOTES);
        $post->id_user = $_SESSION["id"];
        $post->createPublications();


        $view->materrialaddedmessage = "material added";
        $view->header = null;
          $view->material = null;
           
    }
}




$rightp;
$rightp = new UserRightPanel();
$mainplace;



$globaldiv = new GlobalDiv(/* $head, */ $rightp, $view /* , $foot */);
echo $globaldiv->buildForm();
?>