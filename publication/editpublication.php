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
$id_publication=(int)$_GET["id_publication"];

$queryDB ="select  *   from publications,table_users"
                . " where publications.id_user=table_users.id_user and publications.id_public = {$id_publication}  limit 1";

 $link =  mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site",$link);
        //print_r(mysql_error($link));
         $result = mysql_query($queryDB,$link); 


if (isset($_POST["header_of_pub"]) && isset($_POST["body_of_pub"])) {
    $arg["header_of_pub"] = $_POST["header_of_pub"];
    $arg["body_of_pub"] = $_POST["body_of_pub"];
}


$rightp = new UserRightPanel();




$pub_creat_view = new PublicationsCreatorView($arg);


$globaldiv = new GlobalDiv(/* $head, */ $rightp, $pub_creat_view /* , $foot */);
echo $globaldiv->buildForm();
