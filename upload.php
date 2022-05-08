<?php
require_once './config/Database.php';
require_once './config/functions.php';
require_once './header.php';
require_once './footer.php';
require_once './config/Google.php';

if(!$_SESSION['logged']){
	header("Location: index.php"); 
}

// If the form is submitted 
if(isset($_POST['submit'])){ 
	if(empty($_FILES["file"]["name"])){ 
        $valErr .= 'Please select a file to upload.<br/>'; 
    } else {
    	$google = new Google();
    	$files = $google->insert_file_to_drive($_FILES['file']['tmp_name'], $_FILES["file"]["name"], $_SESSION['current_folder']);
    	echo '<div class="container">';
    	echo '<div class="bs-docs-section clearfix" style="margin-top: 100px;">';
		echo '<div class="row">';
		echo '<div class="col-md-12">';
    	if($files['name'] == ''){
        	echo '<div class="alert alert-danger">
            		<strong>Error!</strong> <br/>
                    	Error in uploading file.</a>.
                  </div>';
        } else {
        	echo '<div class="alert alert-success">
            		<strong>Well done!</strong> <br/>
                    	You successfully uploaded the file <a title="Click to View" href="https://drive.google.com/open?id='.$files['id'].'" target="_balnk" class="alert-link">'.$files['name'].'</a>.
                  </div>';
        }
    	echo '</div>';
    	echo '</div>';
    	echo '</div>';
    	echo '</div>';
    } 
} else{ ?>
<div class="container">
<div class="bs-docs-section clearfix" style="margin-top: 100px;">
<div class="row">
<div class="col-md-12">
    <form method="post" action="" class="form" enctype="multipart/form-data">
        <div class="form-group">
            <label>Select File</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn-primary" name="submit" value="Upload"/>
        </div>
    </form>
</div>
</div>
</div>
</div>
<?php } 
 