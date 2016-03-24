<?php
//admin panel

require_once $_SERVER['DOCUMENT_ROOT'].'/library/autoload.php';

$session = new SessionControler();

if ((SessionControler::is_Session() == true && SessionControler::isAdmin()) == false) {
   
    $arr_arg = array("message" => "Ви не можете тут знаходитися",
        "address_redirect" => LocationControler::getMainPage(), "text_redirect" => "Повернутися  на головну  сторінку ");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
    
}


if (isset($_GET["login"]) == false || isset($_GET["mode"]) == false) {
    
    $arr_arg = array("message" => "Неправильно передані параметри",
        "address_redirect" => LocationControler::getAdminPage(), "text_redirect" => "Повернутися  в адмінську панель");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
}


$rightp_selected = 1;
$mainplace;
if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = (int) $_GET["page"];
    if ($page <= 0) {
        $page = 1;
    }
}

$login=htmlspecialchars($_GET["login"], ENT_QUOTES);

$login_query = "&login={$login}";
$sqlcheck = new SqlManager();
$sqlcheck->selectQuery("select * from table_users where login=\"{$login}\" limit 1");
if($sqlcheck->getNumRow()!=1)
{
    $arr_arg = array("message" => "Даного користувача з логіном \"{$login}\" не існує",
        "address_redirect" => LocationControler::getAdminPage(), "text_redirect" => "Повернутися  в адмінську панель");
    $page = new InformPageView($arr_arg);
    echo $page;
    return ;
    
    
}





if ($_GET["mode"] == "userinfo") {

    $arg = array("listpub" => LocationControler::getUserPage() . "?mode=publications{$login_query}",
        "listcomm" => LocationControler::getUserPage() . "?mode=comments{$login_query}",
        "deleteaction" => LocationControler::getUserFolder() . "userdelete.php?login={$login}",
        "editaction" => LocationControler::getUserPage() . "?mode=edituser{$login_query}");

    $rightp_selected = 1;
    $mainplace = new UserInfoView($_GET["login"], $arg);
} elseif ($_GET["mode"] == "publications") {
    $rightp_selected = 2;
    $mainplace = new PublicationListView($page, LocationControler::getUserPage() . "?mode=publications{$login_query}&<\$page_number>", " and table_users.login=\"{$login}\" ");
} elseif ($_GET["mode"] == "comments") {
    $rightp_selected = 3;
    $mainplace = new CommentListViewExt($page, 1, LocationControler::getUserPage() . "?mode=comments{$login_query}&<\$page_number>", " and table_users.login=\"{$login}\"  order by comments_of_pub.id_comment ");
} elseif ($_GET["mode"] == "edituser") {
    $rightp_selected = 4;
    $arr_mess = array();
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["save_personal_info"])) 
        {
            chagePersonalInfo($_POST,(int)$_POST["id_user"],$arr_mess);
            
        } 
        elseif (isset($_POST["save_email"]))
        {
            if (checkEmail($_POST["email"], $check_email)) {
                changeEmail($_POST["email"], SessionControler::getCurrentId());
                $arr_arg["email_m"] = "Email змінено на {$_POST["email"]}";
            } else {
                $arr_arg+=$check_email;
            }
            
        } 
        elseif (isset($_POST["save_admission"])) 
        {
            if(isset($_POST["admission"])&&($_POST["admission"]=="admin"||$_POST["admission"]=="user"))
            {
                  $sql = new SqlManager();
    $sql->selectQuery("update table_users set admission=\"{$_POST["admission"]}\" where id_user={$_POST["id_user"]} limit 1  ");
    $arr_mess["admission_m"] ="Права змінено на  {$_POST["admission"]}  "  ;    
    }
            
        } 
        elseif (isset($_POST["save_password"])) 
        {
            changePassword($_POST,$_POST["id_user"],$arr_mess);
            
        } 
        
    }
     $mainplace = new UserProfileEditViewExt($login,$arr_mess);
    
} else {

    //header("Location: ".LocationControler::getAdminPage()."?mode=users");    
    // return;
}


$rightp = new UserInfoRightPanel($_GET["login"], $rightp_selected);

$globaldiv = new GlobalDiv(/* $head, */ $rightp, $mainplace /* , $foot */);
echo $globaldiv->buildForm();

function editUserProfile() {
    
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
    $sql = new SqlManager();   
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






?>