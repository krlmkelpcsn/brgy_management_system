<?php

	$department = $model->displayDepartment2($_SESSION['sess2']);

	if (!empty($department)) {
		foreach ($department as $dep) {
			$r_id = $dep['id'];
			$r_id_number = $dep['id'];
			$r_fname = $dep['fname'];
			$r_mname = $dep['mname'];
			$r_lname = $dep['lname'];
			$r_ext = $dep['ext'];
			$r_gender = $dep['gender'];
			$r_email = $dep['email'];
			$r_contact = $dep['contact_number'];
			$r_occupation = $dep['occupation'];
			$r_civil_status = $dep['civil_status'];
			$r_birth_date = $dep['birth_date'];
			$r_birth_place = $dep['birth_place'];
			$r_address = $dep['address'];
			$r_address2 = $dep['address2'];
			$r_address3 = $dep['address3'];
			$r_resident_since = $dep['resident_since'];
			$r_password = $dep['password'];
			$email_verif = $dep['email_verif'];
			$prof_pic = $dep['prof_pic'];
			
			$income = $dep['income'];
			$family = $dep['family'];
			
			$password = $dep['password'];
			
			if($dep['status'] == '3'){
			   unset($_SESSION['sess2']); 
			   echo "<script>window.open('../registration-archived', '_self')</script>";
			}
			else if($dep['status'] == '5'){
			    unset($_SESSION['sess2']); 
			    echo "<script>window.open('../registration-pending', '_self')</script>";
			}
			else {
			    
			}
		}
	}

	if ($email_verif == "") {
		$model->verifyResidentAccount($_SESSION['sess2']);
		$email_verif = '1';
		
		echo "<script>window.open('welcome', '_self');</script>";
	}
	else { 
		$model->verifyResidentAccount($_SESSION['sess2']);
		$email_verif = '1';
	}

    $rows = $model->website_details();

    if (!empty($rows)) {
        foreach ($rows as $row) {
        	$web_name = $row['web_name'];
        	$web_code = strtoupper($row['web_code']);
            $web_header = $row['web_header'];
            $primary_color = $row['primary_color'];
            $secondary_color = $row['secondary_color'];
            $web_icon = $row['web_icon'];
       	}
    }
		
?> 