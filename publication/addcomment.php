<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';



$session = new SessionControler();
if(SessionControler::is_Session() == false)
{
    $arr_arg = array("message" => "Ви не увыйшли, будьласка залогіньтесь",
        "address_redirect" => LocationControler::getLoginPage(), "text_redirect" => "Перейти на сторінку входу");
    $page = new InformPageView($arr_arg);
    echo $page;
    return;
}

$sql = new SqlManager();
 mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public 
           from   publications
where publications.id_public ={$_POST["id_publication"]} LIMIT 1; ");
$sql->selectQuery("select publications.id_public 
           from   publications
where publications.id_public ={$_POST["id_publication"]} LIMIT 1;" );
       if( $sql->getNumRow()==0)
       {
          $arr_arg = array("message" => "Ви не можете додавати кометарі до публікації якої не існує ",
        "address_redirect" => LocationControler::getLoginPage(), "text_redirect" => "Перейти на сторінку входу");
    $page = new InformPageView($arr_arg);
    echo $page;
    return;
           
       }
       $text_comment = cutStrExt($_POST['text_comment']);
       
             $id_user = SessionControler::getCurrentId();
           $sql->selectQuery("insert into comments_of_pub (id_user,id_publications,datepub,body_of_comment)
           values({$id_user} ,{$_POST['id_publication']},NOW(),\"{$text_comment} \");");
  
   
   
    $arr_arg = array("message" => "Коментар доданий ",
        "address_redirect" => $_SERVER['HTTP_REFERER'], "text_redirect" => "Перейти назад до публікації");
    $page = new InformPageView($arr_arg);
    echo $page;
    return;
       
       
       





//print_r($_POST)."<br>";

//print_r($_SERVER['HTTP_REFERER']);
   
   
   
function cutStrExt($param) 
{
    if(mb_strlen($param)<147)
        return $param;
    $pos=  mb_strpos($param," ",147);
    if($pos<160&&$pos!==false)
    {
     $rest = mb_substr($param, 0, $pos)  ;
     return $rest;
    }
    
     $rest = mb_substr($param, 0, 157)  ;
     $rest=$rest.".....";
     return $rest;
    
    
}


?>