<?php





 $start = microtime(true);


require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


$session = new SessionControler();

$rightp;


if (SessionControler::is_Session() == false) {
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


$globaldiv = new GlobalDiv(/* $head, */ $rightp , new PublicationListView ($page,  LocationControler::getMainIndexPage()."?<\$page_number>","")/*, $foot */);


echo $globaldiv->buildForm();
echo "Время выполнения скрипта: ".(microtime(true) - $start);

?>
