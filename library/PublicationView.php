<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/interfaces/IMainPlaceDiv.php';

require_once '/var/www/server3/library/BaseView.php';
require_once '/var/www/server3/library/CommentViewItem.php';


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
    public $arr_data;
    public $create_comment = false;
    private $pattern_comment_form;
    private $pattern_action_publicaton;
    private $pattern_comment_view;
    public $arr_comments_list;

    public function setEditeable($flag) {
        $this->is_editable = $flag;
    }

    public function setCommentable($flag) {
        $this->is_commentable = $flag;
    }

    public function __construct($data_of_pub, $rating = 0) {
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/publicationview.html";
        $this->pattern_comment_form = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentform.html";
        $this->pattern_action_publicaton = $_SERVER['DOCUMENT_ROOT'] . "/forms/actionpublicationview.html";
        $this->pattern_comment_view = $_SERVER['DOCUMENT_ROOT'] . "/forms/commentsview.html";
        $this->arr_data = $data_of_pub;
    }

    public function buildForm() {

        //$page = new BaseView($this->arr_data,$this->pattern);




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


        $commentsview = file_get_contents($this->pattern_comment_view);
        $commentitemlist = '';
        for ($i = 0; $i < count($this->arr_comments_list); $i++) {
            $commentitem = new CommentViewItem($this->arr_comments_list[$i], $this->arr_comments_list[$i]["editable"]);
            $commentitemlist = $commentitemlist . $commentitem;
        }
        $commentsview = preg_replace('|{\$commentsform}|im', $commentform, $commentsview);
        $commentsview = preg_replace('|{\$commentslist}|im', $commentitemlist, $commentsview);

        // $page =  preg_replace('|{\$comments}|im',$commentsview,  $page);
        $this->arr_data["comments"] = $commentsview;
         $this->arr_data["editable"] = $editform;

        $page = new BaseView($this->arr_data, $this->pattern);



        return $page;
    }

//put your code here
}
