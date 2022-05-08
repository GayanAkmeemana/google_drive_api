<?php
require_once './config/Database.php';
require_once './config/functions.php';
require_once './header.php';
require_once './footer.php';

$_SESSION['current_folder'] = null;
unset($_SESSION['current_folder']); 
if(!empty($_SESSION['status_response'])){ 
    $status_response = $_SESSION['status_response']; 
    $status = $status_response['status']; 
    $statusMsg = $status_response['status_msg']; 
    unset($_SESSION['status_response']); 
} 

?>

<?php if(isset($_SESSION['logged']) && $_SESSION['logged']){
	echo '<div class="container">';
	echo '<div class="bs-docs-section clearfix" style="margin-top: 100px;">';
	echo '<div class="row">';
    echo '<div class="col-md-6 mb-5 text-center">';     
    echo '<a class="btn btn-block btn-success btn-lg text-white" href="./view_files.php">View Folders</a>';                                      
    echo '</div>';
 	echo '<div class="col-md-6 mb-5 text-center">';     
    echo '<a class="btn btn-block btn-success btn-lg text-white" href="./upload.php">Upload Files to the Current Folder</a>';                                      
    echo '</div>';
    echo '</div>';      
    echo '</div>';
    echo '</div>';
} else { 
	include_once './login.php';
} ?>