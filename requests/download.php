<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if(isset($_POST['id'])) {
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	if($user['username']) {
		$feed->user = $user;
		$feed->username = $user['username'];
		$feed->id = $user['idu'];
	}
	
	if(validateSession('download', 10)) {
		$feed->addDownload($_POST['id']);
	}
}

mysqli_close($db);
?>