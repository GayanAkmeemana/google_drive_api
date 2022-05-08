<?php
$_SESSION['current_folder'] = null;
unset($_SESSION['current_folder']); 

if(isset($_POST['submit']) && isset($_POST['req_id']) && isset($_POST['req_id']) == "1G454ERV6FTY69"){ 
	require_once './config/Google.php';
	$google = new Google();
	$login_url = $google->get_login_url();
    header("Location: $login_url"); 
}
?>
<div class="container">
<div class="bs-docs-section clearfix">
	<div class="row">
		<div class="col-md-12">
    		<form method="post" action="" class="form" enctype="multipart/form-data">
        		<div class="form-group">
        	    	<input type="submit" class="form-control btn-primary" name="submit" value="Login using Google"/>
					<input type="hidden" name="req_id" value="1G454ERV6FTY69" />
        		</div>
    		</form>
		</div>
	</div>
</div>
</div>