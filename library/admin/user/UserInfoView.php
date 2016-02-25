<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';


require_once $_SERVER['DOCUMENT_ROOT'].'/library/LocationControler.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfoView
 *
 * @author profesor
 */
class UserInfoView implements IMainPlaceDiv
{
    private  $pattern;
    public $login;
    public function __construct ()
    {
                $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/admin/user/userinfoview.html";
        
       
        
    }
    
    public function buildForm() {
        $page =  file_get_contents($this->pattern);
          
         
        mysql_connect("localhost", "root", "1234");
        mysql_select_db("my_first_site");
        $result = mysql_query("select *from  table_users
where table_users.login = \"{$this->login}\" LIMIT 1; ");
        //$row=mysql_fetch_array($result);
        echo mysql_error();
       if( mysql_num_rows($result)==0)
       {
            echo "Ошибочный запрос: публикации не существуэт";
            return;
           
       }
       $row = mysql_fetch_array($result);
        
        
          $page =  preg_replace('|{\$login}|im',  $row["login"],  $page);
          $page =  preg_replace('|{\$id}|im',  $row["id_user"],  $page);
          $page =  preg_replace('|{\$firstname}|im',  $row["first_name"],  $page);
          $page =  preg_replace('|{\$secondname}|im',  $row["second_name"],  $page);
          $page =  preg_replace('|{\$lastname}|im',  $row["last_name"],  $page);
          $page =  preg_replace('|{\$email}|im',  $row["email"],  $page);
          $page =  preg_replace('|{\$admission}|im',  $row["admission"],  $page);
          $page =  preg_replace('|{\$dateofbirth}|im',  $row["date_of_birth"],  $page);
          $page =  preg_replace('|{\$dateofreg}|im',  "Uncnown",  $page);
          $page =  preg_replace('|{\$address}|im',  $row["address"],  $page);
          $page =  preg_replace('|{\$sex}|im',  $row["sex"],  $page);
          $page =  preg_replace('|{\$deleteuser}|im',  $row["login"],  $page);
          $page =  preg_replace('|{\$edituser}|im',  $row["login"],  $page);
          
          $id_user = $row["id_user"];
          
          $result = mysql_query("select count(*)from  publications where id_user={$id_user};");
           $row = mysql_fetch_array($result);
          
           $page =  preg_replace('|{\$countpub}|im',  $row["count(*)"],  $page );
          
        $result = mysql_query("select count(*)from  comments_of_pub where id_user={$id_user};");
           $row = mysql_fetch_array($result);
          $page =  preg_replace('|{\$countcomm}|im',  $row["count(*)"],  $page );
          
          $page =  preg_replace('|{\$deleteaction}|im',  LocationControler::getAdminPage()."/user/userdelete.php?id_user={$id_user}",  $page );
          $page =  preg_replace('|{\$editaction}|im',  LocationControler::getAdminPage()."/user/useredit.php?id_user={$id_user}",  $page );
        
          return $page;
    }

//put your code here
}
