<?php

require_once $_SERVER['DOCUMENT_ROOT']."/library/BaseView.php";
require_once $_SERVER['DOCUMENT_ROOT']."/library/LocationControler.php";
class RatingActionView
{
private $pattern;
private $view;
public function __construct($action_mode, $id_pub)
{
$this->pattern[1] = $_SERVER['DOCUMENT_ROOT']."/forms/rating/ratinginsertform.html";
$this->pattern[2] = $_SERVER['DOCUMENT_ROOT']."/forms/rating/ratingdelete.html";
$this->pattern[0] = $_SERVER['DOCUMENT_ROOT']."/forms/rating/ratingnoneaction.html";
switch($action_mode)
{


case 1:
{
$this->view = new BaseView(array("id_publication" => $id_pub,
 "action" => LocationControler::getPublicationFolder()."ratingaction.php"), $this->pattern[1]);
}
break;
case 2:
{
$this->view = new BaseView(array("id_publication" => $id_pub,
 "action" => LocationControler::getPublicationFolder()."ratingaction.php"), $this->pattern[2]);

}
break;
default :
{
    $this->view = new BaseView(array("id_publication" => $id_pub,
 "action" => LocationControler::getPublicationFolder()."ratingaction.php"), $this->pattern[0]);
    
}
break;
}
}
public function __toString() 
        {
   
    return $this->view->__toString();

}
//put your code here
}
