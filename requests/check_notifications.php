<?php
require_once(__DIR__ .'/../includes/autoload.php');
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}

if($user['username']) {
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->username = $user['username'];
	$feed->id = $user['idu'];
	$feed->time = $settings['time'];
	$feed->per_page = $settings['perpage'];
	$feed->c_per_page = $settings['cperpage'];
	$feed->c_start = 0;
	if($_POST['for'] == 1) {
		echo $feed->checkNewNotifications($settings['nperwidget'], $_POST['type'], $_POST['for'], $user['notificationl'], $user['notificationc'], $user['notificationf'], $user['notificationd']);
	} else {
		echo $feed->checkNewNotifications($settings['nperwidget'], $_POST['type'], $_POST['for'], $user['notificationl'], $user['notificationc'], $user['notificationf'], $user['notificationd']);
	}
}

mysqli_close($db);
?>