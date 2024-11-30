<?php

	session_start();

	include('../../global/model.php');
	$model = new Model();

	$data = '';

	$rows = $model->fetchAppointmentTime($_POST['appointment_date']);

	if ($rows[0] != 'No result') {
		if (!empty($rows)) {
			foreach ($rows as $time) {
				$data .= $time['time'].', ';
			}
		}
	}

	else {
		$data .= 'No result..';
	}

	$result = substr($data, 0, -2);

	echo $result;

?>