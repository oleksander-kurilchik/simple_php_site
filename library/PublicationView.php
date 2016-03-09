<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';

require_once '/var/www/server3/library/BaseView.php';
require_once '/var/www/server3/library/CommentViewItem.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/RatingActionView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/library/CommentListView.php';/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PublicationView
 *
 * @author profesor
 */
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
        
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login,table_users.admission
from  table_users, publications
where publications.id_user =table_users.id_user and publications.id_public ={$id_publication} LIMIT 1 ");
        //$row=mysql_fetch_array($result);
        echo mysql_error();
        if (mysql_num_rows($result) == 0) {
            echo "Ошибочный запрос: публикации не существуэт";
            return;
        }
        $row = mysql_fetch_array($result);
        $this->arr_data=$row;
        $this->owner_publication = $row["login"];




        $commentform = null;
        $editform = null;
        $rating_action = 0;
        if (SessionControler::is_Session_static() == true) {
            $commentform = new BaseView(array("action" => LocationControler::getPublicationFolder(). "/addcomment.php", "id_publication" => $id_publication)
                    , $this->pattern_comment_form);
            if (SessionControler::getCurrentLogin() == $this->owner_publication || SessionControler::isAdmin_current() == true) {
                $editform = new BaseView(array("action_delete" => LocationControler::getPublicationFolder() . "deletepublication.php"
                    , "action_edit" => LocationControler::getPublicationFolder(). "editpublication.php"
                    , "id_publication" =>$id_publication)
                        , $this->pattern_action_publicaton);
            }
            
            
            
            $result = mysql_query("SELECT * FROM rating_of_pub 
                        where rating_of_pub.id_publication ={$id_publication} "
                    . "and rating_of_pub.id_user =" . SessionControler::getCurrentId() . " LIMIT 1; ");
                        if(mysql_num_rows($result) == 0)
                        {
                            $rating_action =1;
                        }
                        else { $rating_action=2;}
                        
        }
          $ratingview = new RatingActionView($rating_action, $id_publication);
          ///////////////////////////rating result 
          $result = mysql_query("select (SUM(rating)/count(*)) from  rating_of_pub where id_publication={$id_publication}");
          $row_rating = mysql_fetch_array($result);
          
          
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
