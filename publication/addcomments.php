<?php


/*  Доробить провірку на існування*/
require_once '/var/www/server3/library/SessionControler.php';
require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/GlobalDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserRightPanel.php';
$session = new SessionControler();
if($session->is_Session() == false)
{
    echo 'Ви не увійшли , тому не можете оставляти коментарі';
    return;
}
 mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public 
           from   publications
where publications.id_public ={$_POST["id_publication"]} LIMIT 1; ");
        //$row=mysql_fetch_array($result);
        echo mysql_error();
       if( mysql_num_rows($result)==0)
       {
            echo "Ошибочный запрос: публикации не существуэт";
            return;
           
       }
       
       $result = mysql_query("insert into comments_of_pub (id_user,id_publications,datepub,body_of_comment)
           values({$_SESSION['id']},{$_POST['id_publication']},NOW(),\"{$_POST['text_comment']} \");");
              echo "<br>";   
           echo mysql_error()."<br>"; 
           
     // echo "<meta http-equiv=\"refresh\" content=\"5; URL=\"{$_SERVER['HTTP_REFERER']};\" />";
   echo "<br/> коментар доданий";
   echo '<a href="'.$_SERVER['HTTP_REFERER'].'" > Перейти назад до публікації</a> ';
       
       
       





//print_r($_POST)."<br>";

//print_r($_SERVER['HTTP_REFERER']);


?>