<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php'; 


$session = new SessionControler();
if (SessionControler::is_Session() == false) {
     $arr_arg = array("message" => "Ви не увійшли в систему ",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися в на головну сторінку");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ; 
}




$arg = array();
$id_publication=(int)$_REQUEST["id_publication"];
$id_user = SessionControler::getCurrentId();
$sql = new SqlManager();
$sql->selectQuery("select  *   from publications where id_public={$id_publication} limit 1");
if($sql->getNumRow()!=1)
{
     $arr_arg = array("message" => "Публікації з ID:{$id_publication} не існує ",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися в на головну сторінку");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ; 
}
$row = $sql->getRow(0);
if(($row["id_user"]==$id_user||SessionControler::isAdmin())==false)
{
     $arr_arg = array("message" => "Ви не можете редагувати дану публікацію",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися в на головну сторінку");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ; 
}




if($_SERVER["REQUEST_METHOD"]=="GET")
{
   $pub_creat_view = new PublicationsCreatorView($row);
  
    
}
elseif($_SERVER["REQUEST_METHOD"]=="POST")
{
    $pub_creat_view = new PublicationsCreatorView($_POST);
    if($pub_creat_view->isValid())
    {
        $pub_creat_view->createPublication(new PublicationEditor());
         $arr_arg = array("message" => "Ви відредагували публікацію",
        "address_redirect" => LocationControler::getPublicationPage()."?publication={$_POST["id_public"]}", "text_redirect" => "Повернутися в на  сторінку публіуації");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
        
        
    }
   
    
}




$rightp = new UserRightPanel();




//$pub_creat_view = new PublicationsCreatorView($arg);


$globaldiv = new GlobalDiv(/* $head, */ $rightp, $pub_creat_view /* , $foot */);
echo $globaldiv->buildForm();
