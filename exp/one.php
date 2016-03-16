<?php
 
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/SqlManager.php';



$sql=new SqlManager();
$sql->selectQuery("select * from publications");
echo "<pre>";


//print_r($sql->getAllQueryArray());
print_r($sql->getRow(40));
echo "<-----------------br>";
print_r($sql->getNumRow(19));



