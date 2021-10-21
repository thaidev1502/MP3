<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if(isset($_POST['id']) || isset($_POST['type']) || isset($_POST['name']) || isset($_POST['playlist'])) {
	if($user['username']) {
		$feed = new feed();
		$feed->db = $db;
		$feed->url = $CONF['url'];
		$feed->username = $user['username'];
		$feed->id = $user['idu'];
		
		if($_POST['type'] == 1) {
			echo $feed->playlistEntry($_POST['id'], $_POST['playlist'], 1);
		} elseif($_POST['type'] == 2) {
			echo $feed->managePlaylist($_POST['id'], $_POST['type'], $_POST['name']);
		} elseif($_POST['type'] == 3) {
			echo $feed->playlistEntry($_POST['id'], $_POST['playlist'], 3);
		}
	}
}

mysqli_close($db);
?>