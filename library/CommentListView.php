<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';


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
          
        $commentcreator = new CommentItemCreator($typeofitem);
        
       
        $sql = new SqlManager();
        $sql->selectQuery($queryDB);
        $arr_row = $sql->getAllQueryArray();
        
        $is_current_admin = SessionControler::isAdmin();
        $current_id = SessionControler::getCurrentId();
             foreach ($arr_row as $row_c) {                
             $editeble=false;
             if(isset($_SESSION['id'])==true)
             if($row_c["id_user"]==$current_id|| $is_current_admin==true)
             { $editeble=true;}

              $commentitem = $commentcreator->CreateCommentItem($row_c, $editeble);
             
             $commentitemlist = $commentitemlist.$commentitem;
               
         }
         $this->page = new BaseView(array("commentslist"=>$commentitemlist),$this->pattern_comment_view);
         
    }
    public function __toString()
     {
      return  $this->page->__toString();
        
    }
    
    
}
?>