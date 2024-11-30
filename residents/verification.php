<?php
    session_start();
	include('../global/model.php');

	if (password_verify($_POST['code'], $_POST['hashed_code'])) {
		$model = new Model();
		$model->verifyResidentAccount($_SESSION['sess2']);
		echo "<script>window.open('homepage','_self');</script>";
	}

	else {
		echo '<h5 style="color: red; margin-bottom: 0px;">Wrong Code</h5>';
	}

?>