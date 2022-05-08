<?php

require_once './config/Database.php';
require_once './config/functions.php';
require_once './header.php';
require_once './footer.php';
require_once './config/Google.php';

if(!$_SESSION['logged']){
	header("Location: index.php"); 
}

$_SESSION['current_folder'] = null;
unset($_SESSION['current_folder']); 

if(isset($_GET['id']) && $_GET['id'] != ''){
	$_SESSION['current_folder'] = $_GET['id'];
	$google = new Google();
	$files = $google->get_files_folder_list($_GET['id']);
} else {
	$_SESSION['current_folder'] = null;
	unset($_SESSION['current_folder']); 
	$google = new Google();
	$files = $google->get_root_folder_list();
}

?>
<div class="container">
<div class="bs-docs-section clearfix" style="margin-top: 100px;">
	<div class="row">
<?php
//print_r($files);
if(!empty($files)){
	foreach( $files as $k => $file ){
    //print_r($file);
    	if($file['mimeType'] == 'application/vnd.google-apps.folder'){
    		echo '<div class="col-md-3 mb-5 text-center">';
    		echo '<img src="./images/blue-folder-icon-774519.png" alt="..." class="rounded " width=50%> <br/>';
    		echo '<a href="?id='.$file['id'].'">'.$file['name'].'</a>';
    		echo '</div>';
        } else {
        	echo '<div class="col-md-3 mb-5 text-center">';
    		echo '<img src="./images/file.png" alt="..." class="rounded " width=50%> <br/>';
    		echo '<a title="Click to View" href="https://drive.google.com/open?id='.$file['id'].'" target="_balnk">'.$file['name'].'</a>';
    		echo '</div>';
        }
    }
}
?>
	</div>
</div>
</div>