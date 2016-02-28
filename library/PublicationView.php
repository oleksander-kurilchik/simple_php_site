<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';

require_once '/var/www/server3/library/BaseView.php';
require_once '/var/www/server3/library/CommentViewItem.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/RatingActionView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SesionControler.php';

/*
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
    private $is_editable = false;
    private $is_commentable = false;
    private $pattern;
    private $arr_data;
    private $pattern_comment_form;
    private $pattern_action_publicaton;
    private $pattern_comment_view;
    private $arr_comments_list;
    private $rating_action;
    private $rating;

    public function __construct($id_publication) {
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/publicationview.html";
        $this->pattern_comment_form = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentform.html";
        $this->pattern_action_publicaton = $_SERVER['DOCUMENT_ROOT'] . "/forms/actionpublicationview.html";
        $this->rating_action = $rating_action;

        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login,table_users.admission
from  table_users, publications
where publications.id_user =table_users.id_user and publications.id_public ={$_GET["publication"]} LIMIT 1; ");
        //$row=mysql_fetch_array($result);
        echo mysql_error();
        if (mysql_num_rows($result) == 0) {
            echo "Ошибочный запрос: публикации не существуэт";
            return;
        }
        $row = mysql_fetch_array($result);
        $this->owner_publication = $row["login"];




        $commentform = null;
        $editform = null;
        $rating_action = 0;
        if (SessionControler::is_Session_static() == true) {
            $commentform = new BaseView(array("action" => LocationControler::getMainPage()
                . "/viewpublic/addcomments.php", "id_publication" => $_GET["publication"])
                    , $this->pattern_comment_form);
            if (SessionControler::getCurrentLogin() == $this->owner_publication || SessionControler::isAdmin_current() == true) {
                $editform = new BaseView(array("action_delete" => LocationControler::getMainPage() . "/viewpublic/deletepublication.php"
                    , "action_edit" => LocationControler::getMainPage() . "/viewpublic/editpublication.php"
                    , "id_publication" => $_GET["publication"])
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
          
          $rating_result = new BaseView(array("rating_result" => $rating ? " Середня Оцінка ". $this->rating : "За матеріал ніхто не голосував"), $_SERVER['DOCUMENT_ROOT'] . "/forms/rating/ratingresult.html");
           
          
          //////////////////////////////////////// comment list
          $commentlist = new CommentListView(" and comments_of_pub.id_publications={$id_publication} order by  	id_comment  ");
          //////
          
          
          
          
          
          
          
        
        
        
    }

    public function buildForm() {

        /*
          $commentform = null;
          if ($this->is_commentable == true) {
          $commentform = new BaseView(array("action" => LocationControler::getMainPage()
          . "/viewpublic/addcomments.php", "id_publication" => $_GET["publication"])
          , $this->pattern_comment_form);
          }
         */
        $editform = null;
        if ($this->is_editable == true) {
            $editform = new BaseView(array("action_delete" => LocationControler::getMainPage() . "/viewpublic/deletepublication.php"
                , "action_edit" => LocationControler::getMainPage() . "/viewpublic/editpublication.php"
                , "id_publication" => $_GET["publication"])
                    , $this->pattern_action_publicaton);
        }


        print_r($this->arr_comments_list);
        $commentsview = file_get_contents($this->pattern_comment_view);
        $commentitemlist = '';
        for ($i = 0; $i < count($this->arr_comments_list); $i++) {
            $commentitem = new CommentViewItem($this->arr_comments_list[$i], $this->arr_comments_list[$i]["editable"]);
            $commentitemlist = $commentitemlist . $commentitem;
        }



        $ratingview = new RatingActionView($this->rating_action, $_GET["publication"]);
        $rating_result = new BaseView(array("rating_result" => $this->rating ? $this->rating : "За матеріал ніхто не голосував"), $_SERVER['DOCUMENT_ROOT'] . "/forms/rating/ratingresult.html");




        $commentsview = preg_replace('|{\$commentsform}|im', $commentform, $commentsview);
        $commentsview = preg_replace('|{\$commentslist}|im', $commentitemlist, $commentsview);

        // $page =  preg_replace('|{\$comments}|im',$commentsview,  $page);


        $this->arr_data["rating_result"] = $rating_result;
        $this->arr_data["rating_action"] = $ratingview;
        $this->arr_data["editable"] = $editform;
        $this->arr_data["comments"] = $commentsview;
        $page = new BaseView($this->arr_data, $this->pattern);



        return $page;
    }

//put your code here
}
