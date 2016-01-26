<?php

include_once './addmaterialview.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
}
if ($flag == true) {
    echo " material added";
} else {
    echo $view->buildForm();
}
?>