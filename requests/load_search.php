<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if(!empty($_POST['start']) && !empty($_POST['q'])) {
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	
	if($user['username']) {
		$feed->user = $user;
		$feed->id = $user['idu'];
		$feed->username = $user['username'];
		$feed->time = $settings['time'];
	}
	$feed->per_page = $settings['sperpage'];
	$feed->categories = $feed->getCategories();
	$feed->l_per_post = $settings['lperpost'];
	$feed->profile = $_POST['profile'];
	$feed->profile_data = $feed->profileData($_POST['profile']);
	$messages = $feed->searchTracks($_POST['start'], $_POST['q']);
	echo $messages[0];
}

mysqli_close($db);
?>