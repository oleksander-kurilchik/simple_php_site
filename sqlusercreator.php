<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sqlusercreator
 *
 * @author profesor
 */
class SqlUserCreator {
    public $login;
    public $fname;
    public $sname;
    public $lname;
    public $password;
    public $email;
    public $sex;
    public $dateofbirdth;
    public $dateofreg;
    public $address;
    public function __construct() 
            {
                
        
        
            }
public function createUser()
{
    mysql_connect("localhost","root","1234");
        mysql_select_db("my_first_site");
        $query ="insert into table_users  (login,first_name,second_name,"
               . "last_name,email,hesh_password,date_of_birth,address,sex )"
               . "values(\"{$this->login}\",\"{$this->fname}\",\"{$this->sname}\",\"{$this->lname}\","
               . "\"{$this->email}\",\"{$this->password}\",\"{$this->dateofbirdth}\""
               . ",\"{$this->address}\",\"{$this->sex}\") "; 
                
       echo $query."<br>";
                
       $result = mysql_query($query);
       die(mysql_error());   
}





    //put your code here
}
