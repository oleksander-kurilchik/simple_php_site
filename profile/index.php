<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/LocationControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SessionControler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/ProfileRightPanel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserPublicationView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/profile/UserEditProfileView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/GlobalDiv.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserProfileEditView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/PublicationListView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/UserInfoViewLite.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/CommentListViewExt.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/reg_validador.php';


$session = new SessionControler();

if ($session->is_Session() == false) {
    header("Location: " . LocationControler::getLoginPage());
    return;
}

if ((isset($_GET["mode"])) == false) {
    header("Location: " . LocationControler::getProfillePage() . "/index.php?mode=viewprofile");

    return;
}


$rightp_select = 1;

$mainplace;

if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = (int) $_GET["page"];
    if ($page <= 0) {
        $page = 1;
    }
}



if ($_GET["mode"] == "viewprofile") {
    $arg = array("listpub" => LocationControler::getProfillePage() . "?mode=publications", "listcomm" => LocationControler::getProfillePage() . "?mode=comments");
    $mainplace = new UserInfoViewLite($_SESSION['login'], $arg);
    $rightp_select = 1;
} elseif ($_GET["mode"] == "publications") {

    $rightp_select = 2;
    $mainplace = new PublicationListView($page, LocationControler::getProfillePage() . "?mode=publications&<\$page_number>", "and table_users.id_user={$_SESSION['id']} ");
} elseif ($_GET["mode"] == "editprofile") {

    $arr_arg = buildArrForPIEdit();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["save_personal_info"])) {
            $arr_mess=array();
            chagePersonalInfo($_POST, SessionControler::getCurrentId(), $arr_mess);
           $arr_arg+= $arr_mess;
            
        } elseif (isset($_POST["save_email"])) {

            if (checkEmail($_POST["email"], $check_email)) {
                changeEmail($_POST["email"], SessionControler::getCurrentId());
                $arr_arg["email_m"] = "Email змінено на {$_POST["email"]}";
            } else {
                $arr_arg+=$check_email;
            }
        } elseif (isset($_POST["save_password"])) 
            {
            changePassword($_POST,SessionControler::getCurrentId(),$arr_arg);
            
        }

        print_r("<pre>");
        print_r($_SERVER["REQUEST_METHOD"]);
        print_r("<br>");
        print_r($_POST);
        print_r("</pre>");
    }
    $rightp_select = 4;
    $mainplace = new UserProfileEditView($_SESSION["login"], $arr_arg);
} elseif ($_GET["mode"] == "comments") {
    $rightp_select = 3;
    $mainplace = new CommentListViewExt($page, 1, LocationControler::getProfillePage() . "?mode=comments&<\$page_number>", " and table_users.login=\"{$_SESSION["login"]}\" ");
} else {
    header("Location: " . LocationControler::getProfillePage() . "/index.php?mode=viewprofile");

    return;
}


$rightp = new ProfileRightPanel($rightp_select);

$globaldiv = new GlobalDiv(/* $head, */ $rightp, $mainplace /* , $foot */);
echo $globaldiv->buildForm();

function buildArrForPIEdit() {
    $url = LocationControler::getMainPage() . $_SERVER["REQUEST_URI"];


    $arr_arg;
    $arr_arg["action_edit_email"] = $url;
    $arr_arg["action_epi"] = $url;
    $arr_arg["action_edit_password"] = $url;
    return $arr_arg;
}

function checkPassword() {
    
}

function checkPersonalInfo() {
    
}

function checkEmail($email, &$error_message) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (isEmailExists($email)) {
            $error_message["email_m"] = "Email вже заннятий";
            return false;
        }
        return true;
    }
    $error_message["email_m"] = "Email некоректний";
    return false;
}

function isEmailExists($email) {

    $sql = new SqlManager();
    $sql->selectQuery("select email from  table_users where email=\"{$email}\" limit 1  ");
    if ($sql->getNumRow() == 1) {


        return true;
    }
    return false;
}

function changeEmail($email, $id_user) {

    $sql = new SqlManager();
    $sql->selectQuery("update table_users set email=\"{$email}\" where id_user={$id_user} limit 1  ");
}

function changePassword($array, $id_user,&$arr_mess) 
{
    $flag=true;
  
    $old_pass_hesh= sha1($array["old_password"]);
    $sql = new SqlManager();
    $sql->selectQuery("select * from table_users where id_user={$id_user} and hesh_password=\"{$old_pass_hesh}\" limit 1");
     if($sql->getNumRow()!=1)
    {
        $arr_mess["old_password_m"]="Старий пароль не вірний";
       $flag= false;
        
    }  
    if($array["new_password"]==$array["rnew_password"])
    {
        if(strlen($array["new_password"])<8 )
        {
            $arr_mess["new_password_m"]="Пароль надто короткий";
       $flag= false;
        }
        
        
    }  
    else {
       $arr_mess["new_password_m"]="Паролі не співпадають";
       $arr_mess["rnew_password_m"]="Паролі не співпадають";
       $flag= false;
               
    }
    if($flag==true)
    {
        $new_pass_hesh= sha1($array["new_password"]);
          $sql->selectQuery("update table_users set hesh_password=\"{$new_pass_hesh}\" where id_user={$id_user} limit 1");
         $arr_mess["new_password_m"]="Пароль успішно змінено";
    }
       
   
    
}





function chagePersonalInfo($arr, $id_user, &$arr_mess) {
    $flag = true;
    $array_query=array();
    $array_return=array();
    if ($arr["first_name"] != null) {
        if (RegistrationValidator::isValidFSLName($arr["first_name"], $arr["first_name"])) {
            $array_query["first_name"] = $arr["first_name"];
        } else {
            $arr_mess["first_name" . "_m"] = "Імя не коректне";
            $flag = false;
        }
    }
    if ($arr["second_name"] != null) {
        if (RegistrationValidator::isValidFSLName($arr["second_name"], $arr["second_name"])) {
            $array_query["second_name"] = $arr["second_name"];
        } else {
            $arr_mess["second_name" . "_m"] = "Призвище не коректне коректне";
            $flag = false;
        }
    }
    if ($arr["last_name"] != null) {
        if (RegistrationValidator::isValidFSLName($arr["last_name"], $arr["last_name"])) {
            $array_query["last_name"] = $arr["last_name"];
        } else {
            $arr_mess["last_name" . "_m"] = "Побатькові не коректне";
            $flag = false;
        }
    }
    if ($arr["address"] != null) {
        if (RegistrationValidator::isValidAddress($arr["address"], $arr["address"])) {
            $array_query["address"] = $arr["address"];
        } else {
            $arr_mess["address" . "_m"] = "Адреса не коректна";
            $flag = false;
        }
    }
    if ($arr["date_of_birth"] != null) {
        if (RegistrationValidator::isValidDate($arr["date_of_birth"], $arr["date_of_birth"])) {
            $array_query["date_of_birth"] = $arr["date_of_birth"];
        } else {
            $arr_mess["date_of_birth" . "_m"] = "Дата народження не коректна";
            $flag = false;
        }
    }
    if ($arr["sex"] != null && ($arr["sex"] == "male" || $arr["sex"] == "female")) {
        $array_query["sex"] = $arr["sex"];$array_return[$arr["sex"]."_s"]=" selected ";
    }
    if ($flag == true && count($array_query) > 0) 
    {
        $arr_mess["pinfoinfoedited"]="Персональні дані Змінено";
         $sql = new SqlManager();
          foreach ($array_query as $key=>$value  )
        {
              $sql->selectQuery("update table_users set {$key}=\"{$value}\" where id_user={$id_user} limit 1   ");                     
        }
        return true;
    } 
    else {
        foreach ($array_query as $key=>$value  )
        {
            $array_return[$key.'_v']=$value;           
        }
        
        $arr_mess = $array_return+$arr_mess;
        print_r($arr_mess);
        return false;
    }
}

function isExistAllPersonalInfo($arr, &$message) {
    //$arr_name = array("first_name","","");    потім розобраться
}
?>


?>

