<?php

require_once $_SERVER['DOCUMENT_ROOT']."/library/BaseView.php";
require_once $_SERVER['DOCUMENT_ROOT']."/library/LocationControler.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';




$session = new SessionControler();

if ($session->is_Session() == false) {
    
    $arr_arg=array("message"=>"Ви не увыйшли, будьласка залогіньтесь",
        "address_redirect"=>  LocationControler::getLoginPage(),"text_redirect"=>"Перейти на сторінку входу"); 
   $page =  new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/informpage.html" );
   echo $page;
    return;
}


print_r($_POST);

if(isset( $_POST["mode"])==false||isset( $_POST["id_publication"])==false)
{
     $arr_arg=array("message"=>"Неправильно передані параметри",
        "address_redirect"=>  LocationControler::getMainPage(),"text_redirect"=>"Перейти на головну сторінку"); 
   $page =  new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/informpage.html" );
     echo $page;
    return;
      
}


$id_publication = (int) $_POST["id_publication"];
$is_exsist_rating;

          $commentitemlist = '';
          $queryDB = "select * from rating_of_pub
where rating_of_pub.id_user={$_SESSION["id"]}  and rating_of_pub.id_publication={$id_publication} limit 1";
  
      $link =  mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site",$link);
         $result = mysql_query($queryDB,$link);
      $is_exsist_rating =  mysql_num_rows($result);




$iduser = $_SESSION["id"];
$mode = $_POST["mode"];
if($mode=="insert")
{
    if($is_exsist_rating==0)
    {
        $rating = (int )$_POST["rating_pub"];
        if($rating>0&&$rating<6)
        {
        
       $queryDB = "insert into rating_of_pub (id_user,id_publication,rating) values($iduser,$id_publication,{$rating})"; 
        mysql_query($queryDB,$link);
         $arr_arg=array("message"=>"Оцінка Додана",
        "address_redirect"=> $_SERVER["HTTP_REFERER"],"text_redirect"=>"Перейти на попередню сторінку"); 
   $page =  new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/informpage.html" );
     echo $page;
     return;
        
        
        }
    }
    
    
}
elseif ($mode=="delete")
{
    
     if($is_exsist_rating==1)
    {
    $queryDB = "delete from rating_of_pub where id_user={$iduser} and "
    . "id_publication={$id_publication}"; 
        mysql_query($queryDB,$link);
    $arr_arg=array("message"=>"Оцінка Видалення ",
        "address_redirect"=> $_SERVER["HTTP_REFERER"],"text_redirect"=>"Перейти на попередню сторінку"); 
   $page =  new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/informpage.html" );
     echo $page;
     return;
    }
    

}
$arr_arg=array("message"=>"Неправильно передані параметри",
        "address_redirect"=>  LocationControler::getMainPage(),"text_redirect"=>"Перейти на головну сторінку"); 
   $page =  new BaseView($arr_arg,$_SERVER['DOCUMENT_ROOT']."/forms/informpage.html" );
     echo $page;
    return;






?>