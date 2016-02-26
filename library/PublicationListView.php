<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/PublicationNavigator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';


class PublicationListView implements IMainPlaceDiv {
    private $page;
    private $login;
    private $count_page;
    private $current_url;
    
    public function __construct($page,$count_page=0,$current_url=0,$login=0)
    {
        $this->page = $page;
        $this->login = $login;
        $this->count_page = $count_page;
        $this->current_url = $current_url;

        
    }
    private function getDataFromDB($page,$login)
    {
          mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select * from publications,table_users where publications.id_user=table_users.id_user limit ".((string)($page-1)*6) .", ". ((string)6));
        mysql_close();
        
        print_r(mysql_error());
        
      
        while ($row = mysql_fetch_array($result))
                { $arr_get[]=$row; }
                return $arr_get;
        
    }

        public function buildForm()
         {
           $list_pub="";
           $arr_list = $this->getDataFromDB(1,0);
           print_r($arr_list);
           foreach ($arr_list as $key => $value )
           {    $item = new BaseView($value,$_SERVER['DOCUMENT_ROOT'] ."/forms/publicationitem.html");
                  
           
                   
               $list_pub =$list_pub. $item;
           }
                   if(( $this->count_page - $this->page ) > 0)
                   {
                      $next = array ("address"=>$this->current_url."&page=".($this->page+1),"text"=>" Next Page ".($this->page+1)); 
                   }
                    if($this->page  >1)
                   {
                      $prev = array ("address"=>$this->current_url."&page=".($this->page-1),"text"=>" Prev Page ".($this->page-1)); 
                   }
                    if($this->page  >0)
                   {
                      $current = array ("address"=>$this->current_url."&page=".($this->page),"text"=>" Current Page ".($this->page)); 
                   }
                   
                   
           $navigator = new PublicationNavigator($current,$prev,$next);
           
           $page = new BaseView(array("publication_list"=>$list_pub,navigator=>$navigator),"/var/www/server3/forms/publicationlistview.html");
           
           
           return  $page;
        
    }

//put your code here
}
?>
