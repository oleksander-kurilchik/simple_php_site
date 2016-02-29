<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentListView.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlManager
 *
 * @author profesor
 * 
 * 
 */
/*

$current = array ("address"=>"","text"=>"current page 3");
$prev = array ("address"=>"http://prev","text"=>" Prev Page 2");
$next = array ("address"=>"http://next","text"=>" Next Page 4");
*/

$pppp = new PublicationView(1);
  /// $pppp = new CommentListView(0);
   echo $pppp->buildForm();
   
   
   
//$db = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

class SqlManager {
     function __construct(  ) {
        
    }


    //put your code here
}
