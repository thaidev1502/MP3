<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if(isset($_POST['id']) && isset($_POST['type'])) {
	if($user['username']) {
		$feed = new feed();
		$feed->db = $db;
		$feed->url = $CONF['url'];
		$feed->title = $settings['title'];
		$feed->username = $user['username'];
		$feed->id = $user['idu'];
		$feed->profile = $_POST['profile'];
		$feed->email = $CONF['email'];
		$feed->profile_data = $feed->profileData(null, $_POST['id']);
		$feed->email_new_friend = $settings['email_new_friend'];
		$feed->subscriptionsList = $feed->getSubs($feed->id, 0, null);
		
		$result = $feed->getSubscribe($_POST['type'], null, $_POST['z']);
		echo $result;
	}
}

mysqli_close($db);
?>