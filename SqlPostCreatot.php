<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SqlPostCreatot
 *
 * @author profesor
 */
class SqlPostCreatot 
{
    public $header;
    public $post_data;
    public $dateofcretion;
     public $dateoflastEdit;
     public $id_user;
     
     public function __construct() 
     {
         $this->dateofcretion =date('Y-m-d H:i:s');;
         $this->dateoflastEdit =date('Y-m-d H:i:s');;
         
         
     }


     public function createPublications()
{
    mysql_connect("localhost","root","1234");
        mysql_select_db("my_first_site");
        $query ="insert into publications  (header_of_pub,body_of_pub,date_of_creation,"
               . "date_of_last_edit,id_user)"
               . "values(\"{$this->header}\",\"{$this->post_data}\",\"{$this->dateofcretion}\",\"{$this->dateoflastEdit}\","
               . "\"{$this->id_user}\" ) "; 
                
      
                
       $result = mysql_query($query);
       
}
    //put your code here
}
