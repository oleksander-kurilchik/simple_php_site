<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

$session = new SessionControler();
if (SessionControler::is_Session() == false) {
    
    $arr_arg = array("message" => "Ви не залогінилися",
        "address_redirect" => LocationControler::getLoginPage(), "text_redirect" => "Повернутися  на   сторінку входу ");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
}


if($_SERVER["REQUEST_METHOD"]=="GET")
{
   $pub_creat_view = new PublicationsCreatorView(array());
   print_r($_SERVER["REQUEST_METHOD"]);
  
    
}
elseif($_SERVER["REQUEST_METHOD"]=="POST")
{
    print_r($_SERVER["REQUEST_METHOD"]);
    $_POST["id_user"]=  SessionControler::getCurrentId();
    $pub_creat_view = new PublicationsCreatorView($_POST);
    
    if($pub_creat_view->isValid())
    {
        $pub_creat_view->createPublication(new PublicationCreator());
         $arr_arg = array("message" => "Ви створили публікацію",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися  на головну  сторінку ");
    $page = new v($arr_arg);
    echo $page;
    return ;
       
        
   }
   
    
}



$rightp = new UserRightPanel();




//$pub_creat_view = new PublicationsCreatorView($arg);


$globaldiv = new GlobalDiv(/* $head, */ $rightp, $pub_creat_view /* , $foot */);
echo $globaldiv->buildForm();
