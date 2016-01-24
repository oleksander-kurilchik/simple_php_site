<?php

require_once './registrationview.php';
require_once './sqlregvalidator.php';
require_once './sqlusercreator.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reg_validador
 *
 * @author profesor
 */

//sosdatm klas z danimy i oshibkami
class RegistrationValidator {

    public static function isValidPostValue(array $arr, RegistrationView $viev, SqlUserCreator $creator) {
        $flag = true;
        if (self::isValidLogin($arr["login"], $match)==true) {
            if (SqlRegValidator::isLoginExists($arr["login"]) == false) {
                $creator->login = $match;
                        $viev->login = $match;
            } else {
                $viev->loginmessage = "Login Exist";
                $flag = false;
               
            }
        } else {
            $viev->loginmessage = "Login Incorect";
            $flag = false;
        }
       
        if (self::isValidFSLName($arr["firtsname"], $match) == true) {
            $creator->fname = $match; $viev->firstname = $match;
        } else {
            $viev->firstnamemessage = "First name incorect";
            $flag = false;
        }
        if (self::isValidFSLName($arr["secondname"], $match) == true) {
            $creator->sname = $match; $viev->secondname = $match;
        } else {
            $viev->secondnamemessage = "Second name incorect";
            $flag = false;
        }
         if (self::isValidFSLName($arr["lastname"], $match) == true) {
            $creator->lname = $match;$viev->lastname = $match;
        } else {
            $viev->lastnamemessage = "Last name incorect";
            $flag = false;
        }
        if($arr["password_1"]==$arr["password_2"])
        {
            if(strlen($arr["password_1"])>=8)
            {
                $creator->password=  sha1($arr["password_1"]);
            }
            else { $viev->password1_message = "Password so small";  $flag = false;}           
        }else {$viev->password2_message = "Password ne odinakoviy";  $flag = false;}
        /*must to be checked*/ 
       if (self::isValidDate($arr["date_of_bird"], $match) == true) {
            $creator->dateofbirdth = $match;  $viev->date_of_birth = $match;

        } else {
            $viev->date_of_birthmessage = "date_of_birth incorect";
            $flag = false;
        }
        
         if (self::isValidEmail($arr["email"], $match) == true) {
           if(SqlRegValidator::isEmailExists($arr["email"])==false)
           {
               $creator->email = $match;$viev->email = $match;
           }
            else {$viev->emailmessage = "email exist";
                  $flag = false;}
             
        } else {
            $viev->emailmessage = "email incorect";
            $flag = false;
        }
        if (self::isValidAddress($arr["address"], $match) == true) {
            $creator->address = $match;$viev->address = $match;
        } else {
            $viev->addressmessage = "Address incorect";
            $flag = false;
        }
          if (self::isValidSex($arr["sex"], $match) == true) {
            $creator->sex = $match;
        } else {
            $viev->sexmessage = "Sex incorect";
            $flag = false;
        }
        return $flag;
        
        
        
        
        
    }

    public static function isValidLogin( $login, &$match) {
        if (preg_match('|^\s*((([[:alnum:]_]+[-_.]?)+[[:alnum:]_]+){6,40})\s*$|', $login, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }
public static function isValidSex( $sex, &$match) {
            $sex = preg_replace('|[\s]+|', '', $sex);

        if (preg_match('#^\s*(male|female)\s*$#', $sex, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }
    public static function isValidEmail( $email, &$match) {
        if (preg_match('|^\s*('
                        . '([[:alnum:]]+[-_.]?)+[[:alnum:]]+'
                        . '@'
                        . '(([[:alnum:]]+[-._]?[[:alnum:]]+\.)+)'
                        . '[a-zA-Z]{2,5}'
                        . ')\s*$|', $email, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }

    public static function isValidFSLName( $name, &$match) {

        $name = preg_replace('|[\s]{2,}|', ' ', $name);

        if (preg_match('|^\s*(([[:alpha:]]{2,}+[\s]*)+([[:alpha:]]{2,})?)\s*$|', $name, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }

    public static function isValidAddress( $addr, &$match) {


        $addr = preg_replace('|[\s]{2,}|', ' ', $addr);

        if (preg_match('|^\s*(([[:alpha:]]{2,}+[\s]*)+[[:alpha:]]+)\s*$|', $addr, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }
     public static function isValidDate( $date, &$match) {


        $date = preg_replace('|[\s]{2,}|', '', $date);

        if (preg_match('#^\s*([0123]?[\d][.][012]?[\d][.](19|20)[\d]{2})\s*$#', $date, $matches) == true) {
            $match = $matches[1];
            return true;
        }
        return false;
    }

    //put your code here
}
