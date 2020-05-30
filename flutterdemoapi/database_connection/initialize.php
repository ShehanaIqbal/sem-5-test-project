<?php
	require_once('manager.php');
	// Starting session
		session_start();
		$manager=manager::getInstance(session_id());
?>