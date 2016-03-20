<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/SqlRegValidator.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/BaseView.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/registration/RegistrationValidator.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrationview
 *
 * @author profesor
 * E
 */
class RegistrationView {

    private $page;
    private $pattern;
    private $arr_arg;
    private $is_valid = false;

    public function __construct($arr_arg= null) {
        $this->arr_arg = $arr_arg;
        $this->pattern = $_SERVER['DOCUMENT_ROOT'] . "/forms/registrationview.html";
        print_r("--------------------<br><pre>");
        print_r($this->arr_arg);
        print_r("--------------------<br></pre>");
        if($this->arr_arg!=null)
        {  
        $this->validate();        
        }
        else{$this->arr_arg=array();}
        $this->page = new BaseView($this->arr_arg, $this->pattern);
        $this->page->deleteAllMarks();
    }

    public function BuildForm() {

        return $this->page->__ToString();
    }
    public function registrationUser() 
    {
        if($this->is_valid==true)
        {
            $heshp = sha1($this->arr_arg["password1"]);
            $query="insert into table_users (login,first_name,second_name,last_name,email,hesh_password,"
                    . "date_of_birth,date_of_registration ,address,sex)"
                    . " values({$this->arr_arg["login"]},{$this->arr_arg["first_name"]},{$this->arr_arg["second_name"]},"
                    . "{$this->arr_arg["last_name"]},{$this->arr_arg["email"]},{$heshp},{$this->arr_arg["date_of_birth"]},NOW(),"
                    . "{$this->arr_arg["address"]},{$this->arr_arg["sex"]})";
            
         $sql = new SqlManager();
         $sql->selectQuery($query);
         
         return true;   
            
            
        }
        return false;
    }
    

    public function isValid() {

        return $this->is_valid;
    }

    private function validate() {
        print_r($this->arr_arg);
        $flag = true;
        if (RegistrationValidator::isValidLogin($this->arr_arg ["login"])) {
            if (SqlRegValidator::isLoginExists($this->arr_arg ["login"])) {
                $this->arr_arg ["login_m"] = "Такий логін існує ";
                $flag = false;
                $this->arr_arg ["login"] = "";
            }
        } else {
            $this->arr_arg ["login_m"] = "Логін має не коректний формат ";
            $flag = false;
            $this->arr_arg ["login"] = "";
        }
        if (!RegistrationValidator::isValidFSLName($this->arr_arg ["first_name"])) {
            $this->arr_arg ["first_name_m"] = "Імя має не коректний формат ";
            $flag = false;
            $this->arr_arg ["first_name"] = "";
        }
        if (!RegistrationValidator::isValidFSLName($this->arr_arg ["second_name"])) {
            $this->arr_arg ["second_name_m"] = "Призвище має не коректний формат ";
            $flag = false;
            $this->arr_arg ["second_name"] = "";
        }
        if (!RegistrationValidator::isValidFSLName($this->arr_arg ["last_name"])) {
            $this->arr_arg ["last_name_m"] = "По батькові має не коректний формат ";
            $flag = false;
            $this->arr_arg ["last_name"] = "";
        }
        if (strlen($this->arr_arg ["password1"]) >= 8) {
            if ($this->arr_arg ["password1"] != $this->arr_arg ["password2"]) {
                $this->arr_arg ["password1_m"] = "Паролі не співпадають ";
                $this->arr_arg ["password2_m"] = "Паролі не співпадають ";
                $flag = false;
            }
        } else {
            $this->arr_arg ["password1_m"] = "Пароль надто короткий";
            $flag = false;
        }
        if (!RegistrationValidator::isValidSex($this->arr_arg ["sex"])) {
            unset($this->arr_arg ["sex"]);
            $flag = false;
            $this->arr_arg ["sex_m"] = "Не правильно передані дані";
        } else {
            $this->arr_arg[$this->arr_arg ["sex"]] = "selected";
        }

        if (!RegistrationValidator::isValidDate($this->arr_arg ["date_of_bird"])) {
            $this->arr_arg ["date_of_bird_m"] = "Дата народження має не коректний формат ";
            $flag = false;
            $this->arr_arg ["date_of_bird"] = "";
        }
        if (RegistrationValidator::isValidEmail($this->arr_arg ["email"])) 
        {
         if(SqlRegValidator::isEmailExists($this->arr_arg ["email"])) 
         {
             $this->arr_arg ["email_m"] = "Дана електрона скринька вже існує ";
            $flag = false;
            $this->arr_arg ["email"] = "";
         }
        }
        else {
            $this->arr_arg ["email_m"] = "Електрона скринька має не коректний формат ";
            $flag = false;
            $this->arr_arg ["email"] = "";
        }
        if (!RegistrationValidator::isValidAddress($this->arr_arg ["address"])) {
            $this->arr_arg ["address_m"] = "Адреса має не коректний формат ";
            $flag = false;
            $this->arr_arg ["address"] = "";
        }





        print_r("<br><pre>");
        print_r($this->arr_arg);
        $this->is_valid = $flag;
    }

    //put your code here
}
