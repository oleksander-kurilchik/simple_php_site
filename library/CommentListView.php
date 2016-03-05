<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/CommentItemCreator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/BaseView.php';


class CommentListView {
    private $page;
    
    private $pattern_comment_view;
    
    public function __construct ($query=null,$typeofitem=0) 
    {
        
        
         $this->pattern_comment_view = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentsview.html";
if($query==null)
{$query="";}
        
          $commentitemlist = '';
          $queryDB = "select comments_of_pub.datepub,comments_of_pub.id_comment, comments_of_pub.body_of_comment, comments_of_pub.id_publications,table_users.login   ,table_users.id_user  
from table_users,comments_of_pub
where comments_of_pub.id_user=table_users.id_user  {$query}";
          
       


        
      $link =  mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site",$link);
         $result = mysql_query($queryDB,$link);
        //$row=mysql_fetch_array($result);
        
        echo mysql_error($link);
        $commentcreator = new CommentItemCreator($typeofitem);
        
         while ($row_c = mysql_fetch_array($result))
         {
             $editeble=false;
             if(isset($_SESSION['id'])==true)
             if($row_c["id_user"]==$_SESSION['id'] || $_SESSION['admission']=="admin")
             { $editeble=true;}

              $commentitem = $commentcreator->CreateCommentItem($row_c, $editeble);
             
             $commentitemlist = $commentitemlist.$commentitem;
                        
                          
                              

           
         }
         $this->page = new BaseView(array("commentslist"=>$commentitemlist),$this->pattern_comment_view);
         
         
        
        
      

         mysql_close($link);
        
    }
    public function __toString()
     {
      return  $this->page->__toString();
        
    }
    
    
}
?>