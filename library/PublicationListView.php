<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';



class PublicationListView implements IMainPlaceDiv {
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
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select * from publications,table_users where publications.id_user=table_users.id_user limit ".((string)($page-1)*6) .", ". ((string)6));
   
        
        print_r(mysql_error());
        
      
        while ($row = mysql_fetch_array($result))
                { $arr_get[]=$row; }
                return $arr_get;
        
    }

        public function buildForm() {
           $list_pub="";
           $arr_list = $this->getDataFromDB(1,0);
           print_r($arr_list);
           foreach ($arr_list as $key => $value )
           {    $item = new BaseView($value,$_SERVER['DOCUMENT_ROOT'] ."/forms/publicationitem.html");
                  
           
                   
               $list_pub =$list_pub. $item;
           }
            
           return  $list_pub;
        
    }

//put your code here
}
?>
