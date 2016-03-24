<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentListViewExt
 *
 * @author profesor
 */
class CommentListViewExt implements IMainPlaceDiv {
    
     private $page;
    private $query;
    private $count_page;
    private $current_url;
    private $count_item_on_page;
    
    
    
    public function __construct($page,$typeofitem=0,$current_url_pattern=null,$query=null ) 
    {        
        $this->count_item_on_page = 10;
         
        $this->page = $page;
        $this->query = $query;
        $this->current_url = $current_url_pattern;     
        
        $queryDB ="select  count(*)    from comments_of_pub,table_users"
                . " where comments_of_pub.id_user=table_users.id_user ".$this->query."   ";
        
       
        
        $sql = new SqlManager();
        $sql->selectQuery($queryDB);
        
             $row = $sql->getRow(0);
              $this->count_page = ceil($row["count(*)"]/$this->count_item_on_page);
                     $query_comment = $query." limit ".((string)($page-1)*$this->count_item_on_page) .", ".
                      $this->count_item_on_page;

              $list_comments =  new CommentListView($query_comment,$typeofitem);
              
              
              
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
                   
                   
           $navigator = new PageNavigator($current,$prev,$next);
           $this->page = new BaseView(array("commentslist"=>$list_comments,"navigator"=>$navigator),$_SERVER['DOCUMENT_ROOT']."/forms/commentsviewext.html");
              
        
        
        /// limit ".((string)($page-1)*6) .", ". ((string)6). " "
        
    }

    public function buildForm() 
            
    {
        return $this->page->__ToString();
    }

//put your code here
}
