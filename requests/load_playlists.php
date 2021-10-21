<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if(ctype_digit($_POST['start']) && isset($_POST['type']) && isset($_POST['query'])) {
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	if($user['username']) {
		$feed->user = $user;
		$feed->username = $user['username'];
		$feed->id = $user['idu'];
	}
	
	$feed->per_page = $settings['perpage'];
	$feed->profile = $_POST['query'];
	$feed->profile_data = $feed->profileData($_POST['query'], null);
	
	echo $feed->getPlaylists($_POST['start'], $_POST['type'], $_POST['query']);
}

mysqli_close($db);
?>