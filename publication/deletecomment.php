<?php

/*
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/ProfileRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserEditProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserProfileEditView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/PublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserInfoViewLite.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/CommentListViewExt.php';

*/

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


$session = new SessionControler();
echo "<pre>";
print_r($_POST);

if ($session->is_Session() == false) {
       $arr_arg = array("message" => "Ви не залоіынилися",
            "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
}
if(isset($_POST["id_comment"]))
{
   $id_comment = (int)  $_POST["id_comment"];
   $queryDB = "select * from comments_of_pub where id_comment={$id_comment} and id_user={$_SESSION["id"]}   limit 1 ";
    $link = mysql_connect("localhost", "root", "1234");
    mysql_select_db("my_first_site", $link);
    $result = mysql_query($queryDB, $link);
   
    $row_count = mysql_num_rows($result);
    if($row_count!=0||SessionControler::isAdmin_current()==true)
    {
         $queryDB = "delete from comments_of_pub where id_comment={$id_comment}   limit 1 ";
        $result = mysql_query($queryDB, $link);
        
         $arr_arg = array("message" => "Комментар видаленно ",
            "address_redirect" =>  $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку  сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
        
        
        
        
        
    }
    $arr_arg = array("message" => "Помилка  ",
            "address_redirect" =>  $_SERVER["HTTP_REFERER"], "text_redirect" => "Перейти на попередню сторінку  сторінку");
        $page = new BaseView($arr_arg, $_SERVER['DOCUMENT_ROOT'] . "/forms/informpage.html");
        echo $page;
        return;
    
    
    
    
}







?>