<?php
//admin panel

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


$session = new SessionControler();

if((SessionControler::is_Session() ==true&&SessionControler::isAdmin())==false)
{
     $arr_arg = array("message" => "Ви не маєте права тут знаходитися",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Перейти на головну");
    $page = new InformPageView($arr_arg);
    echo $page;
    return;
     
}




if((isset( $_GET["mode"]))==false)
{
     header("Location: ".LocationControler::getAdminPage()."/index.php?mode=users"); 
   
    return;
}


$rightp_selected=1;
$mainplace;
 if (!isset($_GET["page"])) {
        $page = 1;
    } 
 else {
        $page = (int) $_GET["page"];
        if ($page <= 0) {
            $page = 1;
        }
    }



if($_GET["mode"] =="users")
{
    $rightp_selected=1;
    $mainplace = new UserListView($page, LocationControler::getMainPage(). "/admin/index.php?mode=users&<\$page_number>");
}
elseif ($_GET["mode"] =="publications")
{
    $rightp_selected=2;
    $mainplace  =  new PublicationListView ($page, LocationControler::getAdminPage()."?mode=publications&<\$page_number>");
    

}
elseif ($_GET["mode"] =="comments")
{
    $rightp_selected=3;
    $mainplace = new CommentListViewExt ($page,1,LocationControler::getAdminPage()."?mode=comments&<\$page_number>"," order by comments_of_pub.id_comment ");
}
 else 
{
        header("Location: ".LocationControler::getAdminPage()."?mode=users"); 
   
    return;

}


$rightp = new AdminRightPanel($rightp_selected);

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();














?>