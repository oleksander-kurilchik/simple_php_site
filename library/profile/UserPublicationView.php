<?php


require_once '/var/www/server3/interfaces/IMainPlaceDiv.php';
require_once '/var/www/server3/library/LocationControler.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPuplicationView
 *
 * @author profesor
 */
class UserPublicationView implements IMainPlaceDiv {

    private $pattern;
    private $patternitem;
    public $login;

    public function __construct() {
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . '/forms/userpublications.html';
        $this->patternitem = $_SERVER['DOCUMENT_ROOT'] . '/forms/publicationitrem.html';
    }

    private function buildItem($row) {
        $str = file_get_contents($this->patternitem);
        $str = preg_replace('|{\$login}|im', NULL, $str);
        $str = preg_replace('|{\$login}|im', NULL, $str);
        $str = preg_replace('|{\$login}|im', NULL, $str);
        $str = preg_replace('|{\$login}|im', NULL, $str);
    }

    public function buildForm() {


        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select publications.id_public , publications.header_of_pub,publications.body_of_pub
           ,publications.date_of_creation,publications.date_of_last_edit,table_users.login
from  table_users, publications
where publications.id_user =table_users.id_user and table_users.login=\"{$this->login}\"; ");
        //$row=mysql_fetch_array($result);
        $pibitembase = file_get_contents($this->patternitem);
        $publicitemsresult = '';
        while ($row = mysql_fetch_array($result))
                {
            $pibitem = $pibitembase;
            $pibitem = preg_replace('|{\$header}|im', $row["header_of_pub"], $pibitem);
             $pibitem = preg_replace('|{\$pub_addres}|im', LocationControler::getPublicationPage()."?publication=".$row["id_public"], $pibitem);
            $pibitem = preg_replace('|{\$publicationbody}|im', mb_strimwidth($row["body_of_pub"], 0, 100, "..."), $pibitem);
            $pibitem = preg_replace('|{\$date_ofpubliucation}|im', $row["date_of_creation"], $pibitem);
            // $pibitem =  preg_replace('|{\$user}|im', $row["header_of_pub"],  $pibitem);
            $pibitem = preg_replace('|{\$id_publication}|im', $row["id_public"], $pibitem); 
            $pibitem = preg_replace('|{\$user}|im', $row["login"], $pibitem);/*
              $pibitem =  preg_replace('|{\$header}|im', NULL,  $pibitem);
              $pibitem =  preg_replace('|{\$header}|im', NULL,  $pibitem); */

            $publicitemsresult = $publicitemsresult. $pibitem;
            
          

        }




        $page = file_get_contents($this->pattern);
        $page = preg_replace('|{\$publications}|im',$publicitemsresult, $page);

     /*   $page = preg_replace('|{\$login}|im', NULL, $page);
        $page = preg_replace('|{\$loginmessage}|im', NULL, $page);
        $page = preg_replace('|{\$passwordmessage}|im', NULL, $page);
      
      */

        return $page;
        return $page;
    }

}
