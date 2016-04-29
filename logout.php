<?php
	include 'connection.php';
	unset($_SESSION['uname']);
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION);
	$user->redirect('login.php?logout=success');

?>