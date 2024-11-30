<?php
	   session_start();
	include 'global/model.php';
    
    $model = new Model();
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

    $rows = $model->content_management();
    if (!empty($rows)) {
        foreach ($rows as $row) {
            $story = $row['story'];
            $mission = $row['mission'];
            $vission = $row['vission'];
            $guidelines = $row['guidelines'];
            $brgy_head = $row['brgy_head'];
            $brgy_head_pic = $row['brgy_head_pic'];
            $clearance = $row['clearance'];
            $residency = $row['residency'];
            $indigency = $row['indigency'];
            $fb_link = $row['fb_link'];
            $iframe = $row['iframe'];
            
            $fb = $row['fb_link'];
			$email = $row['email'];
			$contact = $row['contact'];
			
			$img1 = $row['img1'];
			$img2 = $row['img2'];
        }
    }

    $rows = $model->visits();

    if (!empty($rows)) {
        foreach ($rows as $row) {
            $total = $row['total'];
        }
    }

    $date = date("Y-m-d H:i:s");
    $add = $model->add_visit($date);

    if ($add) {
    } 
    else {
        
    }
    
    if (empty($_SESSION['sess2'])) {
	}
	else {
	    $department = $model->displayDepartment2();

	if (!empty($department)) {
		foreach ($department as $dep) {
			$r_id_number = $dep['id_number'];
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
			
			if ($prof_pic == "") {
			    $prof_pic = "default.jpg";
			}
		}
	}
	}

?>