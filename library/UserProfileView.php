<?php
require_once '/var/www/server3/interfaces/IMainPlaceDiv.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserProfileView
 *
 * @author profesor
 */
class UserProfileView implements IMainPlaceDiv {
     private $pattern;
     public $login;
    public function __construct() 
    {
         $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/profileinfoview.html";
        
    }    
    public function buildForm() 
    { 
        mysql_connect("localhost","root","1234");
        mysql_select_db("my_first_site");
       $result = mysql_query("select * from  table_users where login=\"{$this->login}\"   limit 1  ");
        $row=mysql_fetch_array($result);
        echo '<pre>';
        print_r(mysql_error());
           echo '</pre>';
        //return  $row["admission"];
        /* */
        
          $page =  file_get_contents($this->pattern);
          
         
          $page =  preg_replace('|{\$login}|im', $this->login,  $page);
          $page =  preg_replace('|{\$firstname}|im',$row["first_name"],  $page);
          $page =  preg_replace('|{\$secondname}|im',$row["second_name"],  $page);
          $page =  preg_replace('|{\$lastname}|im', $row["last_name"],  $page);
          $page =  preg_replace('|{\$admission}|im',$row["admission"],  $page);
          $page =  preg_replace('|{\$email}|im',$row["email"],  $page);
          $page =  preg_replace('|{\$dateofbirth}|im',$row["date_of_birth"],  $page);
          $page =  preg_replace('|{\$sex}|im', $row["sex"],  $page);
          $page =  preg_replace('|{\$address}|im', $row["address"],  $page);
          
          
          return $page;
        
    }
}

/*
login {$login} <br/>
    Firstname {$firstname}<br/>
    Secondname {$secondname} <br/>
    last name {$lastname}<br/>
    Admidion  {$admission}<br/>
    Email {$email}<br/>
    Date of birth {$dateofbirth}<br/>
    Sex   {$sex}<br/> 
    Address {$address}<br/>
   */
?>