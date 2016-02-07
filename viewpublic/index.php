<?php
///viev public


require_once '/var/www/server3/library/UserPublicationView.php';
require_once '/var/www/server3/library/LocationControler.php';
require_once '/var/www/server3/library/SessionControler.php';
require_once '/var/www/server3/library/ProfileRightPanel.php';
require_once '/var/www/server3/library/UserProfileView.php';
require_once '/var/www/server3/library/UserPublicationView.php';
require_once '/var/www/server3/library/UserEditProfileView.php';
require_once '/var/www/server3/library/GlobalDiv.php';
require_once '/var/www/server3/library/GuestRightPanel.php';
require_once '/var/www/server3/library/PublicationView.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/library/UserRightPanel.php';

$session = new SessionControler();


if($_GET["publication"]==NULL||(preg_match('|^[0-9]++$|', $_GET["publication"])==false))
{
   echo "Ошибочный запрос: не указан publication";
   return;
   
}

  mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login,table_users.admission
from  table_users, publications
where publications.id_user =table_users.id_user and publications.id_public ={$_GET["publication"]} LIMIT 1; ");
        //$row=mysql_fetch_array($result);
        echo mysql_error();
       if( mysql_num_rows($result)==0)
       {
            echo "Ошибочный запрос: публикации не существуэт";
            return;
           
       }

$row = mysql_fetch_array($result);


$mainplace  = new PublicationView($row);
if($session->is_Session() ==false)
{
    $rightp = new GuestRightPanel();
    
}
else
 {
$rightp = new UserRightPanel();
if($_SESSION["login"] ==$row["login"] ||$row["admission"]=="admin" )
{
    $mainplace->setPublicationEditable(true);
}    
}





/*
elseif ($_GET["mode"]=="publications")
{
     $mainplace = new UserPublicationView ();
      $mainplace->login = $_SESSION['login'];
}
elseif ($_GET["mode"]=="editprofile")
{
     $mainplace = new UserEditProfileView();
}
*/

$globaldiv = new GlobalDiv(/*$head,*/ $rightp, $mainplace /*, $foot*/);
echo $globaldiv->buildForm();

?>