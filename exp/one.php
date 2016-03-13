<?php
 //header("POST /two.php HTTP/1.0\r\n ");
 header("Host: http://server3\r\n ");
 header("Request Method: POST\r\n");
 header("Referer: http://server3.one.php\r\n");

 header("Content-Type: application/x-www-form-urlencoded\r\n");
 header("Content-Length: 35\r\n");
 header("Location: two.php");
 

echo 'login=Petya%20Vasechkin&password=qq';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

