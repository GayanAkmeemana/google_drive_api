<?php 
/**
 * User: Gayan Akmeemana
 * Date: 2022-04-26
 */
require_once './config/Google.php';

if(isset($_GET['code'])){ 
	$google = new Google();
	$google->validate();
} 


?>