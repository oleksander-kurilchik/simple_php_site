<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';



class PublicationListView implements IMainPlaceDiv {
    private $page;
    private $query;
    private $count_page;
    private $current_url;
    private $count_item_on_page;
    
    public function __construct($page,$current_url_pattern=null,$query=null)
    {
        $this->page = $page;
        $this->query = $query;
        $this->current_url = $current_url_pattern;
        $this->count_item_on_page = 6;
        
        $list_pub="";
           $arr_list = $this->getDataFromDB($this->page);
           foreach ($arr_list as $key => $value )
           {   
               
              
              $value["body_of_pub"]=  $rest = mb_substr( $value["body_of_pub"], 0, 305)  ;;//cutStrExt($value["body_of_pub"]);
              $value["body_of_pub"].=".....";
              $value["pub_addres"] = LocationControler::getPublicationPage()."?publication=".$value["id_public"];
               
               $item = new BaseView($value,$_SERVER['DOCUMENT_ROOT'] ."/forms/publicationitem.html");
                  
           
                   
               $list_pub =$list_pub. $item;
           }
           
           ///navigator
          
            
           $next=$prev=$current=0;
                   if(( $this->count_page - $this->page ) > 0)
                   {
                       $url = preg_replace('|<\$page_number>|im', "page=".($this->page+1), $this->current_url);
                      $next = array ("address"=> $url,"text"=>" Next Page ".($this->page+1)); 
                   }
                    if($this->page  >1)
                   {
                        $url = preg_replace('|<\$page_number>|im', "page=".($this->page-1), $this->current_url);
                      $prev = array ("address"=>$url,"text"=>" Prev Page ".($this->page-1)); 
                   }
                    if($this->page  >0)
                   {
                      $current = array ("address"=>"","text"=>" Current Page ".($this->page)); 
                   }
                   
                   
           $navigator = new PublicationNavigator($current,$prev,$next);
           
           $this->page = new BaseView(array("publication_list"=>$list_pub,"navigator"=>$navigator),$_SERVER['DOCUMENT_ROOT']."/forms/publicationlistview.html");
           
           
           
        
      
        
        
        

        
    }
    private function getDataFromDB($page)
    {
        
        $query = "select  publications.id_public ,publications.date_of_creation,publications.body_of_pub,publications.header_of_pub, table_users.login   from publications,table_users"
                . " where publications.id_user=table_users.id_user ".$this->query.
                " order by publications.id_public    limit ".((string)($page-1)*$this->count_item_on_page) .", ". ((string)$this->count_item_on_page). " ";
        
        $sql = new SqlManager();
        $sql->selectQuery($query);
        $arr_get= $sql->getAllQueryArray();
      $sql->selectQuery("select  count(*)    from publications,table_users"
                . " where publications.id_user=table_users.id_user ".$this->query."   ")  ;
             $row = $sql->getRow(0);
              $this->count_page = ceil($row["count(*)"]/$this->count_item_on_page);
                return $arr_get;
        
    }

        public function buildForm()
         {
          return  $this->page;
        
    }



    
    
    
}
?>
