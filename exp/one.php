<?php
 
require_once '/var/www/server3/library/registration/RegistrationView.php';



$page = new RegistrationView($_POST);
echo $page->BuildForm();


