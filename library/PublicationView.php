<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class PublicationView implements IMainPlaceDiv {

    private $page;
    private $owner_publication;
   
    private $pattern;
    private $arr_data;
    private $pattern_comment_form;
    private $pattern_action_publicaton;
   

    public function __construct($id_publication) {
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/publicationview.html";
        $this->pattern_comment_form = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentform.html";
        $this->pattern_action_publicaton = $_SERVER['DOCUMENT_ROOT'] . "/forms/actionpublicationview.html";
        
       
        
        $stringQuery ="select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login,table_users.admission
from  table_users, publications
where publications.id_user =table_users.id_user and publications.id_public ={$id_publication} LIMIT 1 ";
        $sql = new SqlManager();
        $sql->selectQuery($stringQuery);
        $row = $sql->getRow(0);
        $row["body_of_pub"] =  preg_replace('|\[br\]|im', "<br>",   $row["body_of_pub"]);  
        $row["body_of_pub"] =  preg_replace('|\[br\]|im', "<br>",   $row["body_of_pub"]);
        $row["body_of_pub"] = preg_replace('|\[b\](.*)\[/b\]|isU', '<b> $1</b>', $row["body_of_pub"]);
        $row["body_of_pub"] = preg_replace('|\[p\](.*)\[/p\]|isU', '<p> $1</p>', $row["body_of_pub"]);
        $row["body_of_pub"] = preg_replace('|\[i\](.*)\[/i\]|isU', '<i> $1</i>', $row["body_of_pub"]);
        

        
        
        
        
        
        $this->arr_data=$row;
        $this->owner_publication = $row["login"];




        $commentform = null;
        $editform = null;
        $rating_action = 0;
        if (SessionControler::is_Session()== true) {
            $commentform = new BaseView(array("action" => LocationControler::getPublicationFolder(). "/addcomment.php", "id_publication" => $id_publication)
                    , $this->pattern_comment_form);
            if (SessionControler::getCurrentLogin() == $this->owner_publication || SessionControler::isAdmin() == true) {
                $editform = new BaseView(array("action_delete" => LocationControler::getPublicationFolder() . "deletepublication.php"
                    , "action_edit" => LocationControler::getPublicationFolder(). "editpublication.php"
                    , "id_publication" =>$id_publication)
                        , $this->pattern_action_publicaton);
            }
            
            $sql->selectQuery("SELECT * FROM rating_of_pub 
                        where rating_of_pub.id_publication ={$id_publication} "
                    . "and rating_of_pub.id_user =" . SessionControler::getCurrentId() . " LIMIT 1; ");
            
            
                        if($sql->getNumRow() == 0)
                        {
                            $rating_action =1;
                        }
                        else { $rating_action=2;}
                        
        }
          $ratingview = new RatingActionView($rating_action, $id_publication);
          ///////////////////////////rating result 
           $sql->selectQuery("select (SUM(rating)/count(*)) from  rating_of_pub where id_publication={$id_publication}");
           $row_rating =$sql->getRow(0);
          
          
          $rating=(float) $row_rating[0]; 
          
        //select (SUM(rating)/count(*)) from  rating_of_pub where id_publication=1          
          
          $rating_result = new BaseView(array("rating_result" => $rating ? " Середня Оцінка {$rating}"  : "За матеріал ніхто не голосував"), $_SERVER['DOCUMENT_ROOT'] . "/forms/rating/ratingresult.html");
           
          
          //////////////////////////////////////// comment list
          $query_comment = " and comments_of_pub.id_publications={$id_publication} order by  	id_comment  ";
          $commentlist = new CommentListView ($query_comment);
         
          
          
          //////
            $this->arr_data["rating_result"] = $rating_result;
        $this->arr_data["rating_action"] = $ratingview;
        $this->arr_data["rating_result"] = $rating_result;
        $this->arr_data["editable"] = $editform;
        $this->arr_data["comments"] = $commentlist;
        $this->arr_data["commentsform"] = $commentform;
        
          

          
          $this->page = new BaseView($this->arr_data, $this->pattern);
          
          
          
          
          
        
        
        
    }

    public function buildForm() {

       

        return $this->page;
    }

//put your code here
}
