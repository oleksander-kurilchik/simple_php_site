<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';

require_once '/var/www/server3/library/BaseView.php';
require_once '/var/www/server3/library/CommentViewItem.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/RatingActionView.php';

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

    public function setEditeable($flag) {
        $this->is_editable = $flag;
    }

    public function setCommentable($flag) {
        $this->is_commentable = $flag;
    }

    public function __construct($data_of_pub,$arr_comment_list=0, $rating_action=0 ,$rating = 0) {
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/publicationview.html";
        $this->pattern_comment_form = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentform.html";
        $this->pattern_action_publicaton = $_SERVER['DOCUMENT_ROOT'] . "/forms/actionpublicationview.html";
        $this->pattern_comment_view = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentsview.html";
        $this->arr_data = $data_of_pub;
        $this->arr_comments_list = $arr_comment_list;
        $this->rating_action = $rating_action;
        $this->rating = $rating;
    }
    

    public function buildForm() {

       
        $commentform = null;
        if ($this->is_commentable == true) {
            $commentform = new BaseView(array("action" => LocationControler::getMainPage()
                . "/viewpublic/addcomments.php", "id_publication" => $_GET["publication"])
                    , $this->pattern_comment_form);
        }

        $editform = null;
        if ($this->is_editable == true) {
            $editform = new BaseView(array("action_delete" => LocationControler::getMainPage()."/viewpublic/deletepublication.php"
                ,"action_edit" => LocationControler::getMainPage()."/viewpublic/editpublication.php"
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
        
        $ratingview =  new RatingActionView($this->rating_action ,$_GET["publication"]);
        $rating_result  = new BaseView(array("rating_result"=>$this->rating?$this->rating:"За матеріал ніхто не голосував"  ),$_SERVER['DOCUMENT_ROOT'] . "/forms/rating/ratingresult.html");
        
        
        
        
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
