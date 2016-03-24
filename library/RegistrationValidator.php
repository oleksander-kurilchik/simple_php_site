<?php




/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. pererobit bo preg_match vertae kolichectvo
 */

/**
 * Description of reg_validador
 *
 * @author profesor
 */

//sosdatm klas z danimy i oshibkami
class RegistrationValidator {
    /*

    

    */
    public static function isValidLogin( &$login) {
     
        if (preg_match('|^\s*([[:alnum:]]{3,40})\s*$|', $login, $matches) == true) {
           $login= htmlspecialchars($login, ENT_QUOTES);
        //if (preg_match('|^\s*((([[:alnum:]]+[-_.]?)+[[:alnum:]]+){2,40})\s*$|', $login, $matches) == true) {
            $login = $matches[1];
            
          
            
            return true;
        }
        return false;
    }
public static function isValidSex( &$sex) {
            $sex = preg_replace('|[\s]+|', '', $sex);

        if (preg_match('#^\s*(male|female)\s*$#', $sex, $matches) == true) {
            $sex = $matches[1];
            return true;
        }
        return false;
    }
    public static function isValidEmail( &$email) {
        
         if (filter_var($email, FILTER_VALIDATE_EMAIL))
         {
                 /*
        if (preg_match('|^\s*('
                        . '([[:alnum:]]+[-_.]?)+[[:alnum:]]+'
                        . '@'
                        . '(([[:alnum:]]+[-._]?[[:alnum:]]+\.)+)'
                        . '[a-zA-Z]{2,5}'
                        . ')\s*$|', $email, $matches) == true) {
            $email = $matches[1];*/
            return true;
        }
        return false;
    }

    public static function isValidFSLName( &$name) {

        $name = preg_replace('|[\s]{2,}|', ' ', $name);
       $name= htmlspecialchars($name, ENT_QUOTES);
        
if (preg_match('|^\s*([[:alnum:]]{3,40})\s*$|', $name, $matches) == true) {
       // if (preg_match('|^\s*(([[:alpha:]]{2,}+[\s]*)+([[:alpha:]]{2,})?)\s*$|', $name, $matches) == true) {
            $name = $matches[1];
            return true;
        }
        return false;
    }

    public static function isValidAddress( &$addr) {


        $addr = preg_replace('|[\s]{2,}|', ' ', $addr);
                   $addr= htmlspecialchars($addr, ENT_QUOTES);

       // if (preg_match('|^\s*(([[:alpha:]]{2,}+[\s]*)+[[:alpha:]]+)\s*$|', $addr, $matches) == true) {
            if (preg_match('|^\s*([[:alpha:]]{2,})\s*$|', $addr, $matches) == true) {
            $addr = $matches[1];
            return true;
        }
        return false;
    }
     public static function isValidDate( &$date) {


        $date = preg_replace('|[\s]{2,}|', '', $date);

        if (preg_match('#^\s*((19|20)[\d]{2}[-][012]?[\d][-][0123]?[\d])\s*$#', $date, $matches) == true) {
            $date = $matches[1];
            return true;
        }
        return false;
    }

    //put your code here
}
