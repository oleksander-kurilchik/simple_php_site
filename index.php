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


    

if(isset($_GET["page"]))
{
    $page = (integer) $_GET["page"];
}
else
    {
    $page=1;
    
}

    if($page<=0)
    {
      $page=1;  
    }


$globaldiv = new GlobalDiv(/* $head, */ $rightp , new PublicationListView ($page,"http://server3/index.php?<\$page_number>","")/*, $foot */);


echo $globaldiv->buildForm();
echo "ssddsd";
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>