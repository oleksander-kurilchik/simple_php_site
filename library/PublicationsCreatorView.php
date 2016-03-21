<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

class PublicationsCreatorView implements IMainPlaceDiv {

    private $arr_arg;
    private $is_valid = false;
    private $page;
    private $pattern;

    public function __construct($arr_arg = array()) {
        $this->arr_arg = $arr_arg;
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/publicationcreatorview.html";

        $flag1 = $flag2 = false;
        if (isset($this->arr_arg["header_of_pub"])) {
            $this->arr_arg["header_of_pub"] = htmlspecialchars($this->arr_arg["header_of_pub"], ENT_QUOTES);


            $flag1 = true;
            if (strlen($this->arr_arg["header_of_pub"]) < 15) {
                $this->arr_arg["header_of_pub_m"] = "Header so small";
                $flag1 = false;
            }
            if (strlen($this->arr_arg["header_of_pub"]) > 300) {
                $this->arr_arg["header_of_pub_m"] = "Header very big";
                $flag1 = false;
            }
        }
 
        
        if (isset($this->arr_arg["body_of_pub"])) {

            $this->arr_arg["body_of_pub"] = htmlspecialchars($this->arr_arg["body_of_pub"], ENT_QUOTES);

            $flag2 = true;
            if (strlen($this->arr_arg["body_of_pub"]) < 150) {
                $this->arr_arg["body_of_pub_m"] = "Material so small";
                $flag2 = false;
            }
            if (strlen($this->arr_arg["body_of_pub"]) > 300000) {
                $this->arr_arg["body_of_pub_m"] = "Material very big";
                $flag2 = false;
            }



            
        }
      
        
$this->is_valid = ( ($flag1 == true && $flag2 == true) ? true : false);


        $this->page = new BaseView($this->arr_arg, $this->pattern);
        $this->page->deleteAllMarks();
    }

    public function isValid() {
        return $this->is_valid;
    }

    public function createPublication(PublicationCreator $creator) {
        if ($this->isValid() == true) {
            return $creator->createPublications($this->arr_arg);
        }
        return false;
    }

    public function buildForm() {
        return $this->page;
    }

//put your code here
}

class PublicationCreator {

    protected $arr_arg;

    public function createPublications($arr) {
        $this->arr_arg = $arr;
        
        $query = "insert into publications  (header_of_pub,body_of_pub,date_of_creation,"
                . "date_of_last_edit,id_user)"
                . "values(\"{$this->arr_arg["header_of_pub"]}\","
                . "\"{$this->arr_arg["body_of_pub"]}\","
                . " NOW()  ,"
                . "NOW(),"
                . "\"{$this->arr_arg["id_user"]}\" ) ";
$sql = new SqlManager();
        $sql->selectQuery($query);
                return true;
    }

    //put your code here
}

class PublicationEditor extends PublicationCreator {

    public function createPublications($arr) {
        $this->arr_arg = $arr;
       
        $query = "update  publications  set header_of_pub =\"{$this->arr_arg["header_of_pub"]}\" ,"
                . "  body_of_pub=\"{$this->arr_arg["body_of_pub"]}\"  ,  date_of_last_edit=NOW()"
                . " where id_public ={$this->arr_arg["id_public"]}   ";

        $sql = new SqlManager();
        $sql->selectQuery($query);
        return true;
    }

    //put your code here
}
