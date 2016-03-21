<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class UserListView implements IMainPlaceDiv{

    private $page;
    protected $pattern;
    protected $patternitem;
    private $query;
    private $current_url;
    private $count_page;


    public function __construct($page, $current_url_pattern = null, $query = null) {
        $this->page = $page;
        $this->query = $query;
        $this->current_url = $current_url_pattern;
      $this->initPattern();
        $this->query = "select * from  table_users {$this->query} order by id_user    limit " . ((string) ($page - 1) * 5) . ", " . ((string) 5) . " ";
         $sql= new SqlManager();
         $sql->selectQuery($this->query);
         $arr_row = $sql->getAllQueryArray();
         
         $useritemsresult = '';
         foreach ($arr_row as $row) 
       {
            $row["useraddr"] = LocationControler::getUserPage()."?mode=userinfo&login={$row["login"]}";
            $useritem = new BaseView($row, $this->patternitem);
            $useritemsresult = $useritemsresult . $useritem;
         
        }
        $sql->selectQuery("select  count(*)    from table_users");             
              $row = $sql->getRow(0);
              $this->count_page = ceil($row["count(*)"]/5);
        
        
        
        
        $next = $prev = $current = 0;
        if (( $this->count_page - $this->page ) > 0) {
            $url = preg_replace('|<\$page_number>|im', "page=" . ($this->page + 1), $this->current_url);
            $next = array("address" => $url, "text" => " Next Page " . ($this->page + 1));
        }
        if ($this->page > 1) {
            $url = preg_replace('|<\$page_number>|im', "page=" . ($this->page - 1), $this->current_url);
            $prev = array("address" => $url, "text" => " Prev Page " . ($this->page - 1));
        }
        if ($this->page > 0) {
            $current = array("address" => "", "text" => " Current Page " . ($this->page));
        }


        $navigator = new PageNavigator($current, $prev, $next);

        $this->page = new BaseView(array("userlist" => $useritemsresult, "navigator" => $navigator),  $this->pattern);






    }
    protected function initPattern()
    {
          $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/user/userlistview.html";
        $this->patternitem = $_SERVER['DOCUMENT_ROOT'] . "/forms/user/userlistviewitem.html";
        
    }
 
    public function __toString() 
            {
      return  $this->page->__toString() ;
        
    }

    public function buildForm() {
       return  $this->page->__toString() ;
        
    }

//put your code here
}

?>
