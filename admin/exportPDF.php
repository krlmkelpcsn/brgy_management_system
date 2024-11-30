<?php

function exportToPDF($rows){
    if(isset($_POST["export-pdf"])) { 
		require_once('../tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("BARANGAY CRUZ - RESIDENTS");   
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$obj_pdf->SetDefaultMonospacedFont('helvetica');  
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
		$obj_pdf->setPrintHeader(false);  
		$obj_pdf->setPrintFooter(false);  
		$obj_pdf->SetAutoPageBreak(TRUE, 10);  
		$obj_pdf->SetFont('helvetica', '', 12);  
		$obj_pdf->AddPage(); 
		//ob_start(); 
		$content = '';  
		$content .= '
		<div align="center">
			<img src="header.jpg" height="115" width="470">
			<h2 style="color: black;">RESIDENTS INFORMATION</h2>
		</div>
		<font size="9" face="Courier New">
		<table border="1" cellspacing="0" cellpadding="5">
        	<thead>
        		<tr>
        			<th><b>Name</b></th>
        			<th><b>Gender</b></th>
        			<th><b>Birthdate</b></th>
        			<th><b>Birthplace</b></th>
        			<th><b>Contact</b></th>
        			<th><b>Civil Status</b></th>
        			<th><b>Occupation</b></th>
        			<th><b>Voter Status</b></th>
        			<th><b>Email Address</b></th>
        		</tr>
        	</thead>
        	<tbody>';
        $status = 1;
        $rows = $model->displayResidents($status);
        if (!empty($rows)) {
			foreach ($rows as $row) {
			    $id = $row['id'];
				$id_number = $row['id_number'];
				$first_name = $row['fname'];
				$middle_name = $row['mname'];
				$last_name = $row['lname'];
				$email = $row['email'];
				$contact = $row['contact_number'];
				$gender = $row['gender'];
				$civil_status = $row['civil_status'];
				$address = $row['address'];
				$address2 = $row['address2'];
				$resident_since = $row['resident_since'];
				$date_added = $row['date_registered'];
				$verified = $row['verified'];
				
				$content .= '<tr>
			        <td>'.$last_name.', '.$middle_name.' '.$first_name.'</td>
			        <td>'.$gender.'</td>
			        <td>'.$row['birth_date'].'</td>
			        <td>'.$row['birth_place'].'</td>

			        <td>'.$row['contact_number'].'</td>
			        <td>'.$row['civil_status'].'</td>
			        <td>'.$row['occupation'].'</td>
			        <td>'.$row['resident_status'].'</td>
			        <td>'.$row['email'].'</td>
		        </tr>';
			}
        }
        	
		$content .= '</tbody></table></font>';  
		$content = utf8_encode($content);
		$obj_pdf->writeHTML($content); 
		ob_end_clean();
		$obj_pdf->Output('Residents.pdf', 'I');  
	}

	if (empty($_SESSION['org_sess'])) {
		echo "<script>window.open('../','_self');</script>";
	}
}
	
?>