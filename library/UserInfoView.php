<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class UserInfoView implements IMainPlaceDiv
{
    protected  $pattern;
    private $login;
    private $page;
    public function __construct ($login,$arr_arg = array())
    {
                $this->initPattern();
               $sql = new SqlManager();
$sql->selectQuery("select *from  table_users
where table_users.login = \"{$login}\" LIMIT 1; ");


 $row = $sql->getRow(0);
 
         $id_user = $row["id_user"];
         $sql->selectQuery("select count(*)from  publications where id_user={$id_user};");       
           $row_c_p = $sql->getRow(0);
          $row["countpub"] = $row_c_p["count(*)"]; 
          $sql->selectQuery("select count(*)from  comments_of_pub where id_user={$id_user};");          
           $row_c_c = $sql->getRow(0);
             $row["countcomm"] = $row_c_c["count(*)"];             
              $row = $row + $arr_arg;            
 $this->page = new BaseView($row,$this->pattern)    ;        
    }
    protected function  initPattern()
    {
       $this->pattern = $_SERVER['DOCUMENT_ROOT']."/forms/user/userinfoview.html"; 
    }
    public function buildForm() {
      
          return $this->page->__ToString();
    }

//put your code here
}
