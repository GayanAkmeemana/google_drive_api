<?php
/**
 * User: Gayan Akmeemana
 * Date: 2022-04-26
 */
require_once '././vendor/autoload.php';
require_once '././vendor/google/apiclient-services/src/Drive/Drive.php';
require_once 'Database.php';

class Google
{
    public function __construct(){
        $this->client = new Google_Client();
        $this->client->setClientId(GOOGLE_CLIENT_ID);
        $this->client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $this->client->setRedirectUri(REDIRECT_URI);
        $this->client->setScopes(array(
                "https://www.googleapis.com/auth/plus.login",
                "https://www.googleapis.com/auth/plus.me",
                "https://www.googleapis.com/auth/userinfo.email",
                "https://www.googleapis.com/auth/userinfo.profile",
        		"https://www.googleapis.com/auth/drive"
            )
        );
    }
    public function get_login_url(){
        return  $this->client->createAuthUrl();
    }
	
    public function validate(){
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
        	$_SESSION['logged'] = TRUE;
        	$_SESSION['code'] = $_GET['code'];
            $_SESSION['access_token'] = $this->client->getAccessToken();
        	header("Location: index.php"); 
			exit(); 
        }
    }
	public function get_root_folder_list(){
    	if (isset($_SESSION['code'])) {
        	$this->client->setAccessToken($_SESSION['access_token']);
            $this->client->authenticate($_SESSION['code']);
        	$service = new Google_Service_Drive($this->client);
        	$parameters['pageSize'] = 250;
        	$parameters['q'] = "'root' in parents and trashed=false"; 
        	$parameters['fields'] = 'files(id,name,modifiedTime,owners,mimeType), nextPageToken';
        	$parameters['orderBy'] = 'folder,name';
        	$files = $service->files->listFiles($parameters);
        	return $files;
        }
    }
	public function get_files_folder_list($id = ''){
    	if (isset($_SESSION['code']) && isset($id) && $id != '') {
        	$this->client->setAccessToken($_SESSION['access_token']);
            $this->client->authenticate($_SESSION['code']);
        	$service = new Google_Service_Drive($this->client);
        	$parameters['pageSize'] = 250;
        	$parameters['q'] = "'".$id."' in parents and trashed=false"; 
        	$parameters['fields'] = 'files(id,name,modifiedTime,owners,mimeType), nextPageToken';
        	$parameters['orderBy'] = 'folder,name';
        	$files = $service->files->listFiles($parameters);
        	return $files;
        }
    }
	public function insert_file_to_drive($file_path, $file_name, $parent_file_id = null){
    	if (isset($_SESSION['code'])) {
        	$this->client->setAccessToken($_SESSION['access_token']);
            $this->client->authenticate($_SESSION['code']);
        	$service = new Google_Service_Drive($this->client);
        	$file = new Google_Service_Drive_DriveFile();
        	$file->setName($file_name);
    		if(!empty($parent_file_id)){
        		$file->setParents([$parent_file_id ]);        
    		}
        	$result = $service->files->create( $file,array('data' => file_get_contents($file_path),'mimeType' => 'application/octet-stream','uploadType' => 'multipart'));
    		return $result;
        }
	}
}