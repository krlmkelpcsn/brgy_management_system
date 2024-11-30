<?php

// 	$department = $model->displayDepartment();
// 	if (!empty($department)) {
// 		foreach ($department as $dep) {
// 			$nm = $dep['name'];
// 			$unm = $dep['uname'];
// 			$contact = $dep['contact'];
// 		}
// 	}
    $department = $model->fetchSpecifiedOrgStructure($_SESSION['org_sess']);
    if (!empty($department)) {
        foreach ($department as $dep) {
            $nm = $dep['name'];
            $unm = $dep['email'];
            
            $position = $dep['position'];
            $position_id = $dep['position'];
            $image_unique = $dep['image_unique'];
            $rendered_service = $dep['rendered_service'];
            
            
        }
    }
                                                        if ($position == 0) {
															$position = "Punong Barangay";
														}
                                                        else if ($position == 1) {
															$position = "Barangay Secretary";
														}
														else if ($position == 2) {
															$position = "Barangay Assistant Secretary";
														}
														else if ($position == 3) {
															$position = "Barangay Staff";
														}
														else {
															$position = "N/A";
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
			
			
			$fb= $row['fb_link'];
			$email = $row['email'];
			$contact = $row['contact'];
			
			$img1 = $row['img1'];
			$img2 = $row['img2'];
		}
	}

	$page = "";
	$secondnav = "";
	

									$rows = $model->fetchPunongBrgy(1);
									if (!empty($rows)) {
										foreach ($rows as $row) {
											$abrgy_head_id = $row['id'];
											$abrgy_head = $row['name'];
											$abrgy_head_pic = $row['image_unique'];
										}
									}
	
		
?> 