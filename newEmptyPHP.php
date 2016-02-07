<?php
session_save_path($_SERVER['DOCUMENT_ROOT'].'/session');
session_start();
if (!isset($_SESSION['count']))
{
    $_SESSION['count'] = 0;
}

 $_SESSION['count'] += 1;
?>
<h1><?=$_SESSION['count'];?></h1>
<h1>бвьептлорп лдовіф лоівп олв по иаолр иіов аи</h1>
