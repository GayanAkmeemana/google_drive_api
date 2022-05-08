<?php
$_SESSION['logged'] = FALSE;
unset($_SESSION['logged']); 
unset($_SESSION['code']); 
unset($_SESSION['access_token']); 
session_start();
session_unset();
session_destroy();
header("Location: index.php"); 
exit();
