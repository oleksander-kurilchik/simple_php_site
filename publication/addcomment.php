<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';



$session = new SessionControler();
if(SessionControler::is_Session() == false)
{
    echo 'Ви не увійшли , тому не можете оставляти коментарі';
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
            echo "Ошибочный запрос: публикации не существуэт";
            return;
           
       }
       $text_comment = cutStrExt($_POST['text_comment']);
       
             
           $sql->selectQuery("insert into comments_of_pub (id_user,id_publications,datepub,body_of_comment)
           values({$_SESSION['id']},{$_POST['id_publication']},NOW(),\"{$text_comment} \");");
   echo "<br/> коментар доданий";
   echo '<a href="'.$_SERVER['HTTP_REFERER'].'" > Перейти назад до публікації</a> ';
       
       
       





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