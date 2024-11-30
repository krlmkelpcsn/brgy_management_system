<?php

	include 'vendor/autoload.php';
	include('../global/model.php');
	$model = new Model();

	if ($_FILES['import_excel']['name'] != '') {
		$allowed_extension = array('xls', 'csv', 'xlsx');
		$file_array = explode('.', $_FILES['import_excel']['name']);
		$file_extension = end($file_array);

		if (in_array($file_extension, $allowed_extension)) {
			$file_name = time() . '.' . $file_extension;
  			move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
			$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

			$spreadsheet = $reader->load($file_name);
			
			unlink($file_name);

			$data = $spreadsheet->getActiveSheet()->toArray();

			foreach ($data as $row) {
				$model->importResident($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], 'N/A', 'N/A', 'N/A', $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], 0);
			}
			$message = '<div class="alert alert-success" style="font-family: Rubik; font-size: 16px; font-weight: 400;">Data imported succesfully.</div>';
		}

		else {
			$message = '<div class="alert alert-danger" style="font-family: Rubik; font-size: 16px; font-weight: 400;">Only .xls, .csv, or .xlsx files are allowed.</div>';
		}
	}

	else {
		$message = '<div class="alert alert-danger" style="font-family: Rubik; font-size: 16px; font-weight: 400;">Please select a file.</div>';
	}

	echo $message;

?>