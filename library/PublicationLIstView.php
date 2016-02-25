<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lybrary/BaseView.php';


class PublicationLIstView implements IMainPlaceDiv {
    private $page;
    private $login;
    
    public function __construct($page,$login=0)
    {
        $this->page = $page;
        $this->login = $login;
        

        
    }
    private function getDataFromDB($page,$login)
    {
          mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select comments_of_pub.id_comment , table_users.login,"
                . "comments_of_pub.body_of_comment, comments_of_pub.datepub, comments_of_pub.id_publications"
                . " from comments_of_pub,table_users,publications "
                . " where comments_of_pub.id_user=table_users.id_user "
                . " and comments_of_pub.id_publications = publications.id_public  ".$user_query.$pub_query." order by id_comment");
        //$row=mysql_fetch_array($result);
        $commentitembase = file_get_contents($this->patternitem);
        
        print_r(mysql_error());
        
        $commentitemsresult = '';
        while ($row = mysql_fetch_array($result))
                {}
        
    }

        public function buildForm() {
        
    }

//put your code here
}
?>
