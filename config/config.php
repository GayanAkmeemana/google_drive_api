<?php 
/**
 * User: Gayan Akmeemana
 * Date: 2022-04-26
 */
// Database configuration    
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', ''); 
define('DB_PASSWORD', ''); 
define('DB_NAME', ''); 
 
// Google API configuration 
define('GOOGLE_CLIENT_ID', ''); 
define('GOOGLE_CLIENT_SECRET', ''); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive'); 
define('REDIRECT_URI', 'https://gatech.lk/sliitssoauth/google_drive_sync.php'); 
 
// Start session 
if(!session_id()) session_start(); 
 
?>