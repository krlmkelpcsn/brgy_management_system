<?php

	session_start();
	unset($_SESSION['org_sess']);
	echo "<script>window.open('../admin.php', '_self');</script>";

?>