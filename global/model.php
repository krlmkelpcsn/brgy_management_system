<?php
include('config.php');

	date_default_timezone_set('Asia/Manila');
	Class Model {
		private $server = "localhost";
		private $username = "root";
		private $password = '';
		private $connname = "brgy_pobla";
		private $conn;

		public function __construct() {
			try {
				$this->conn = new mysqli($this->server, $this->username, $this->password, $this->connname);	
			} catch (Exception $e) {
				echo "Connection failed" . $e->getMessage();
			}
		}

		public function filter($address3, $gender, $civil_status){
			$data = null;
			$query = "SELECT * FROM residents WHERE address3 = $address3 AND gender = $gender AND civil_status = $civil_status ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function getGender($stud_id) {
			$query = "SELECT gender FROM residents WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $stud_id);
				$stmt->execute();
				$stmt->bind_result($gender);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						return $gender;
					}
				}
				$stmt->close();
			}
		}

		public function fetchFirstStudentReload($id) {
			$data = null;

			$query = "SELECT a.* FROM residents AS a WHERE a.id = ? AND a.status = 1 LIMIT 1";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function count_Inquries(){
			$data = null;
			$query = "SELECT SUM(IF(read_unread = '0',1,0)) as unread, SUM(IF(read_unread = '1',1,0)) as read_already FROM inquiries";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function signIn($uname, $pword) {
			$query = "SELECT id, pword FROM admin WHERE uname = ? LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $uname);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
							$_SESSION['sess'] = $id;
							echo "<script>window.open('admin/index','_self');</script>";
							exit();
						}

						else {
							echo "<script>alert('Wrong Password!');</script>";
							if (empty($_SESSION['lattempt'])) {
								$_SESSION['lattempt'] = 1;
							}
							
							else {
								switch ($_SESSION['lattempt']) {
									case 1:
										$_SESSION['lattempt']++;
										break;
									case 2:
										$_SESSION['lattempt']++;
										break;
									case 3:
										$_SESSION['lattempt']++;
										break;
									default:
										unset($_SESSION['lattempt']);
										setcookie('rlimited', '5', time() + (60), "/");
										setcookie('expiration_date_admin', time() + (60), time() + (60), "/");
										echo "<script>alert('reached limit!')</script>";
								}
							}
						}
					}
				}
				else {
					echo "<script>alert('Email not found in database!');</script>";
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		public function orgStructureSignIn($uname, $pword, $position_field) {
			$query = "SELECT id, position, password,contact_no FROM org_structure WHERE email = ? LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $uname);
				$stmt->execute();
				$stmt->bind_result($id, $position, $hashed_pass, $contact_no);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
						    if ($position == $position_field) {
    							$_SESSION['org_sess'] = $id;
    							echo "<script>window.open('admin/index','_self');</script>";
								
								include_once('admin/config.php');
								$_SESSION['ccontact'] =$contact_no;
 								sendSMS($contact_no,"THIS IS YOUR OTP CODE  ". rand_strInt(6, 'x') );
   					 $query = conn_update('org_structure', ['otp' => $otp], ['contact' => $_SESSION['ccontact']]);
     							
								echo "<script type='text/javascript'>window.location.href='verification';</script>";
    							exit();
						    }
						    
						    else {
						        echo "<script>alert('Wrong position!');</script>";
						    }
						}

						else {
							echo "<script>alert('Wrong Password!');</script>";
							if (empty($_SESSION['olattempt'])) {
								$_SESSION['olattempt'] = 1;
							}
							
							else {
								switch ($_SESSION['olattempt']) {
									case 1:
										$_SESSION['olattempt']++;
										break;
									case 2:
										$_SESSION['olattempt']++;
										break;
									case 3:
										$_SESSION['olattempt']++;
										break;
									default:
										unset($_SESSION['olattempt']);
										setcookie('orlimited', '5', time() + (60), "/");
										setcookie('oexpiration_date_admin', time() + (60), time() + (60), "/");
										echo "<script>alert('Reached Limit!')</script>";
								}
							}
						}
					}
				}
				else {
					echo "<script>alert('Email not found in database!');</script>";
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		public function orgStaffSignIn($uname, $pword) {
			$query = "SELECT id, password FROM org_structure WHERE email = ? AND status = '101' LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $uname);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
    							$_SESSION['org_sess'] = $id;
    							echo "<script>window.open('admin/index','_self');</script>";
    							exit();
						}

						else {
							echo "<script>alert('Wrong Password!');</script>";
							if (empty($_SESSION['olattempt'])) {
								$_SESSION['olattempt'] = 1;
							}
							
							else {
								switch ($_SESSION['olattempt']) {
									case 1:
										$_SESSION['olattempt']++;
										break;
									case 2:
										$_SESSION['olattempt']++;
										break;
									case 3:
										$_SESSION['olattempt']++;
										break;
									default:
										unset($_SESSION['olattempt']);
										setcookie('orlimited', '5', time() + (60), "/");
										setcookie('oexpiration_date_admin', time() + (60), time() + (60), "/");
										echo "<script>alert('Reached Limit!')</script>";
								}
							}
						}
					}
				}
				else {
					echo "<script>alert('Email not found in database!');</script>";
				}
				$stmt->close();
			}
			$this->conn->close();
		}

		public function residentSignIn($sid, $pw) {
			$query = "SELECT id, password, status, verified FROM residents WHERE email = ?";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $sid);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass, $fetched_status, $verified);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pw, $hashed_pass)) {
							if ($fetched_status == 1) {
								if ($verified == 1) {
									$_SESSION['sess2'] = $id;
									echo "<script>window.open('residents/homepage', '_self');</script>";
									exit();
								}

								else {
									$_SESSION['sess2'] = $id;
									echo "<script>window.open('residents/homepage', '_self');</script>";
									exit();
								}
							}
							else {
								echo "<script>window.open('registration-pending', '_self');</script>";
							}
						}

						else {
							echo "<script>alert('Wrong Password!');</script>";
							if (empty($_SESSION['slattempt'])) {
								$_SESSION['slattempt'] = 1;
							}
							
							else {
								switch ($_SESSION['slattempt']) {
									case 1:
										$_SESSION['slattempt']++;
										break;
									case 2:
										$_SESSION['slattempt']++;
										break;
									case 3:
										$_SESSION['slattempt']++;
										break;
									default:
										unset($_SESSION['slattempt']);
										setcookie('srlimited', '5', time() + (60), "/");
										setcookie('expiration_date', time() + (60), time() + (60), "/");
										echo "<script>alert('Reached limit!');window.open('index.php', '_self')</script>";
								}
							}
						}
					}
				}
				else {
					echo "<script>alert('Email not found in database!');</script>";
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		
		public function residentSignIn2($sid, $pw) {
			$query = "SELECT id, password, status, verified FROM residents WHERE id_number = ?";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $sid);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass, $fetched_status, $verified);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pw, $hashed_pass)) {
							if ($fetched_status == 1) {
								if ($verified == 1) {
									$_SESSION['sess2'] = $id;
									echo "<script>window.open('residents/homepage', '_self');</script>";
									exit();
								}

								else {
									$_SESSION['sess2'] = $id;
									echo "<script>window.open('residents/homepage', '_self');</script>";
									exit();
								}
							}
							else {
								echo "<script>window.open('registration-pending', '_self');</script>";
							}
						}

						else {
							echo "<script>alert('Wrong Password!');</script>";
							if (empty($_SESSION['slattempt'])) {
								$_SESSION['slattempt'] = 1;
							}
							
							else {
								switch ($_SESSION['slattempt']) {
									case 1:
										$_SESSION['slattempt']++;
										break;
									case 2:
										$_SESSION['slattempt']++;
										break;
									case 3:
										$_SESSION['slattempt']++;
										break;
									default:
										unset($_SESSION['slattempt']);
										setcookie('srlimited', '5', time() + (60), "/");
										setcookie('expiration_date', time() + (60), time() + (60), "/");
										echo "<script>alert('Reached limit!');window.open('index.php', '_self')</script>";
								}
							}
						}
					}
				}
				else {
					echo "<script>alert('Brgy ID not found in database!');</script>";
				}
				$stmt->close();
			}
			$this->conn->close();
		}

		public function addResident($address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $resident_status, $contact, $income, $family, $precinct, $special_status) {
					$query = "INSERT INTO residents (address3, birth_place, occupation, fname, mname, lname, birth_date, gender, civil_status, address, address2, resident_since, date_registered, email, password, contact_number, status, verified, resident_status, income, family, precinct, special_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, 'N/A', 'N/A', ?, 1, 0, ?, ?, ?, ?, ?)";
			
					if($stmt = $this->conn->prepare($query)) {
						$date = date("Y-m-d H:i:s");
						$status = 2;
						$stmt->bind_param('sssssssssssssssssss', $address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $contact, $resident_status, $income, $family, $precinct, $special_status);
						$stmt->execute();
        				if($stmt->errno == 1062) {
        					echo "<script>alert('Email is already registered!');window.open('residents', '_self')</script>";
        					return false;
        				} 
        				else {
        				}
						$stmt->close();
					}

					return true;
			}

		public function addResident2($address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $resident_status, $contact, $email, $digits_hash, $income, $family, $precinct, $special_status) {
			
			$query = "INSERT INTO residents (address3, birth_place, occupation, fname, mname, lname, birth_date, gender, civil_status, address, address2, resident_since, date_registered, email, password, contact_number, status, verified, resident_status, income, family, precinct, special_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0, ?, ?, ?, ?, ?)";
			
			if($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$status = 2;
				$stmt->bind_param('sssssssssssssssssssss', $address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $email, $digits_hash, $contact, $resident_status, $income, $family, $precinct, $special_status);
				$stmt->execute();
				if($stmt->errno == 1062) {
					echo "<script>alert('Email is already registered!');window.open('residents', '_self')</script>";
					return false;
				} 
				else {
				}
				$stmt->close();
			}

			return true;
		}
		
		public function addResidentRegister($address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $resident_status, $contact, $email, $digits_hash, $income, $family, $precinct, $special_status, $brgy_id) {
			
			$query = "INSERT INTO residents (address3, birth_place, occupation, fname, mname, lname, birth_date, gender, civil_status, address, address2, resident_since, date_registered, email, password, contact_number, status, verified, resident_status, income, family, precinct, special_status, brgy_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 5, 0, ?, ?, ?, ?, ?, ?)";
			
			if($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$status = 2;
				$stmt->bind_param('ssssssssssssssssssssss', $address3, $bplace, $occupation, $fname, $mname, $lname, $bdate, $gender, $civil_status, $address1, $address2, $res_since, $date, $email, $digits_hash, $contact, $resident_status, $income, $family, $precinct, $special_status, $brgy_id);
				$stmt->execute();
				if($stmt->errno == 1062) {
					echo "<script>alert('Email is already registered!');window.open('registration', '_self')</script>";
					return false;
				} 
				else {
				}
				$stmt->close();
			}

			return true;
		}
		

		public function searchResident($id_number, $last_name) {
			$query = "SELECT id, verified FROM residents WHERE id_number = ? AND lname = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ss', $id_number, $last_name);
				$stmt->execute();
				$stmt->bind_result($id, $verified);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if ($verified == 0) {
							return $id;
						}

						else {
							return 'verified';
						}
					}
				}

				else {
					return false;
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		public function verifiedRegistration($id_number, $address3, $birth_place, $occupation, $address2, $fname, $mname, $lname, $gender, $civil_status, $address, $email, $password, $contact, $birth_date, $id) {
			$query = "UPDATE residents SET id_number = ?, address3 = ?, birth_place = ?, occupation = ?, address2 = ?, fname = ?, mname = ?, lname = ?, gender = ?, civil_status = ?, email = ?, password = ?, contact_number = ?, address = ?, birth_date = ?, verified = ? WHERE id = ?";

			if($stmt = $this->conn->prepare($query)) {
				$verify = 1;

				$stmt->bind_param('sssssssssssssssii', $id_number, $address3, $birth_place, $occupation, $address2, $fname, $mname, $lname, $gender, $civil_status, $email, $password, $contact, $address, $birth_date, $verify, $id);
				$stmt->execute();
				if($stmt->errno == 1062) {
					echo "<script>alert('Email is already registered!');window.open('verify-registration', '_self')</script>";
				} 

				else {
				
				}
				$stmt->close();
			}
		}

		public function verifyResident( $address3, $birth_place, $occupation, $address,$fname, $mname, $lname,$gender, $civil_status,  $email,$contact, $birth_date,  $resident_since, $id) {
		   $query = "UPDATE residents SET  address3 = ?, birth_place = ?, occupation = ?, address = ?,
		   	fname = ?, mname = ?, lname = ?,gender = ?, 
		   civil_status = ?, email = ?,contact_number = ?,  birth_date = ?,  resident_since = ? WHERE id = ?";


			if($stmt = $this->conn->prepare($query)) {
				$verify = 1;

				$stmt->bind_param('sssssssssssssi',  $address3, $birth_place, $occupation, 
				$address,$fname, $mname, $lname, $gender, $civil_status,
				$email, $contact, $birth_date,  $resident_since, $id);
				 $stmt->execute();
				if($stmt->errno == 1062) {
					echo "<script>alert('Email is already registered!');</script>";
				} 

				else {
				
				}
				$stmt->close();
			}
		}

		public function updateResident($id_number, $ext, $address3, $birth_place, $occupation, $address2, $fname, $mname, $lname, $gender, $civil_status, $address, $email, $password, $contact, $birth_date, $id) {
			$query = "UPDATE residents SET id_number = ?, ext = ?, address3 = ?, birth_place = ?, occupation = ?, address2 = ?, fname = ?, mname = ?, lname = ?, gender = ?, civil_status = ?, email = ?, password = ?, contact_number = ?, address = ?, birth_date = ?, verified = ? WHERE id = ?";

			if($stmt = $this->conn->prepare($query)) {
				$verify = 1;

				$stmt->bind_param('ssssssssssssssssii', $id_number, $ext, $address3, $birth_place, $occupation, $address2, $fname, $mname, $lname, $gender, $civil_status, $email, $password, $contact, $address, $birth_date, $verify, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function website_details(){
			$data = null;
			$query = "SELECT * FROM web_details ORDER BY web_id DESC LIMIT 1";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		

		public function content_management(){
			$data = null;
			$query = "SELECT * FROM content_management WHERE id = 1";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function editContent($column, $content) {
			$query = "UPDATE content_management SET ".$column." = ? WHERE id = 1";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('s', $content);
				$stmt->execute();
				$stmt->close();
				
			}
		}
		
		public function visits(){
			$data = null;
			$query = "SELECT COUNT(*) as total FROM visit";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function add_visit($date) {
			$query = "INSERT INTO visit (visit_date) VALUES (?)";
			if ($stmt = $this->conn->prepare($query)) {
			    $stmt->bind_param('s', $date);
			    $stmt->execute();
			    $stmt->close();
				return true;
			}
			else {
				return false;
			}
		}
        
        public function addNarrative($id, $narrative, $date_added) {
			$query = "INSERT INTO narrative (blotter_id, narrative, date_added) VALUES (?, ?, ?)";
			if ($stmt = $this->conn->prepare($query)) {
			    $stmt->bind_param('iss', $id, $narrative, $date_added);
			    $stmt->execute();
			    $stmt->close();
				return true;
			}
			else {
				return false;
			}
		}

		public function addDocument($id, $file_name, $file_size, $file_unique, $narrative, $date_added) {
			$query = "INSERT INTO document (blotter_id, file_name, file_size, file_unique, narrative, date_added) VALUES (?, ?, ?, ?, ?, ?)";
			if ($stmt = $this->conn->prepare($query)) {
			    $stmt->bind_param('isssss', $id, $file_name, $file_size, $file_unique, $narrative, $date_added);
			    $stmt->execute();
			    $stmt->close();
				return true;
			}
			else {
				return false;
			}
		}
		
		public function post_message($user_id, $name, $email, $subject, $message, $date) {
			$query = "INSERT INTO inquiries (resident_id, name, email, subject, message, date_sent) VALUES (?, ?, ?, ?, ?, ?)";
			if ($stmt = $this->conn->prepare($query)) {
			    $stmt->bind_param('ssssss', $user_id , $name, $email, $subject, $message, $date);
			    $stmt->execute();
			    $stmt->close();
				return true;
			}
			else {
				return false;
			}
		}

		public function displayDepartment() {
			$data = null;

			$query = "SELECT * FROM admin WHERE id = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $_SESSION['sess']);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayDepartment2($id) {
			$data = null;
			$query = "SELECT * FROM residents WHERE id = ?";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayResidents($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilter($gender_filter, $status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE gender = ? AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $gender_filter, $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilterVoter($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE resident_status = 'Yes' AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilterNonVoter($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE resident_status = 'No' AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilterIndigent($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE income = '1' AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilterHead($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE family = 'Yes' AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsFilterRegistered($status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE verified = '1' AND email_verif = '1' AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayResidentsProfile($id) {
			$data = null;
			$query = "SELECT * FROM residents WHERE id = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayResidentsProfileBlotter($id, $blot_status) {
			$data = null;
			$query = "SELECT * FROM blotters WHERE resident_id = ? AND status = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $id, $blot_status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		
		public function displayNarrativeDetails($id) {
			$data = null;
			$query = "SELECT * FROM narrative WHERE blotter_id = ? ORDER BY id asc";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayDocumentDetails($id) {
			$data = null;
			$query = "SELECT * FROM document WHERE blotter_id = ? ORDER BY id asc";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		

		public function changeBlotterStatus($status, $blot_id) {
			$query = "UPDATE blotters SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $blot_id);
				$stmt->execute();
				$stmt->close();
			}
		}

	
		
		public function changeBlotterStatus2($status, $blot_id) {
			$query = "UPDATE blotters SET blotter_status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $status, $blot_id);
				$stmt->execute();
				$stmt->close();
			}
		}
		public function changeBlotterStatus3($stat1,$stat2, $blot_id): void {
			$query = "UPDATE blotters SET respondents_status = ?,complainants_status = ?  WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssi', $stat1,$stat2, $blot_id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function fetchInquiries(){
			$data = null;
			$query = "SELECT * FROM inquiries ORDER BY id DESC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function respondInquiry($response, $date_response, $id) {
			$query = "UPDATE inquiries SET response = ?, date_response = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssi', $response, $date_response, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function changeResidentStatus($id, $remarks, $status ) {
			$query = "UPDATE residents SET status = ? ,remarks = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('isi', $status,$remarks, $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function changeApproveResidentStatus($id, $status) {
			$query = "UPDATE residents SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $id);
				$stmt->execute();
				if($stmt->errno == 1062) {
        					echo "<script>alert('Resident ID is already registered!');window.open('residents-pending', '_self')</script>";
        					return false;
        				} 
        				else {
        				}
				$stmt->close();
			}
		}

		public function readInquiries() {
			$query = "UPDATE inquiries SET read_unread = 1 WHERE read_unread = 0";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$stmt->close();
			}
		}
		

		public function deleteInquiry($id) {
			$query = "DELETE FROM inquiries WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->close();

				echo "<script>window.open('inquiries', '_self');</script>";
			}
		}
		
		public function count_Residents2(){
			$data = null;
			$query = "SELECT count(*) as ns FROM residents WHERE resident_status IS NULL";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function deleteOrgStructure($id) {
			$query = "DELETE FROM org_structure WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function deleteAnnouncement($id) {
			$query = "DELETE FROM announcements WHERE id = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function archiveOrgStructure($status, $id) {
			$query = "UPDATE org_structure SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function editAnnouncement($price, $title, $details, $date, $id) {
			$query = "UPDATE announcements SET price=?, title = ?, details = ?, date = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('isssi', $price, $title, $details, $date, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function editAnnouncement2($title, $details, $date, $date2, $id) {
			$query = "UPDATE announcements SET title = ?, details = ?, date = ?, expiration_date = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssssi', $title, $details, $date, $date2, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function editImageAnnouncement($image, $image_unique, $id) {
			$query = "UPDATE announcements SET image = ?, image_unique = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssi', $image, $image_unique, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function archiveAnnouncement($status, $id) {
			$query = "UPDATE announcements SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}
		public function addAnnouncement($title, $details, $base, $unique, $date, $category) {
			$query = "INSERT INTO announcements (title, details, image, image_unique, date, status, category) VALUES (?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$status = 1;

				$stmt->bind_param('sssssii', $title, $details, $base, $unique, $date, $status, $category);
				$stmt->execute();
				$stmt->close();

			}
		}
		
		public function addAnnouncement2($price, $age_from, $age_to, $title, $details, $base, $unique, $date, $expiration_date, $category) {
			$query = "INSERT INTO announcements (price, age_from, age_to, title, details, image, image_unique, date, expiration_date, status, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$status = 1;

				$stmt->bind_param('iiissssssii',$price, $age_from, $age_to, $title, $details, $base, $unique, $date, $expiration_date, $status, $category);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function addStructure($name, $email, $password, $position, $base, $unique, $rendered_service, $status) {
			$query = "INSERT INTO org_structure (name, email, password, position, image, image_unique, rendered_service, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('sssssssi', $name, $email, $password, $position, $base, $unique, $rendered_service, $status);
				$stmt->execute();
				if($stmt->errno == 1062) {
					echo "<script>alert('Email is already registred!');</script>";
				} 
				else {
				}
				$stmt->close();

				
			}
		}

		public function editStructure($name, $email, $position, $rendered_service, $id) {
			$query = "UPDATE org_structure SET name = ?, email = ?, position = ?, rendered_service = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssssi', $name, $email, $position, $rendered_service, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function editStructureImage($image, $unique, $id) {
			$query = "UPDATE org_structure SET image = ?, image_unique = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssi', $image, $unique, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function displayAllAnnouncements($status) {
			$data = null;
 			$query = "SELECT * FROM announcements WHERE status = ?  ORDER BY date DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayAnnouncements($category, $status) {
			$data = null;
			$query = "SELECT * FROM announcements WHERE category = ? AND status = ? ORDER BY id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $category, $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayRecentAnnouncements($category, $status) {
			$data = null;
			$query = "SELECT * FROM announcements WHERE category = ? AND status = ? ORDER BY date DESC LIMIT 5";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $category, $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function displayAnnouncementDetails($category, $status, $id) {
			$data = null;
			$query = "SELECT * FROM announcements WHERE category = ? AND status = ? AND id = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('iii', $category, $status, $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
        
        public function fetchPunongBrgy($status) {
			$data = null;
			$query = "SELECT * FROM org_structure WHERE status = ? AND position = 0 ORDER BY position ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function fetchOrgStructure($status) {
			$data = null;
			$query = "SELECT * FROM org_structure WHERE status = ? AND purok_no='' ORDER BY position ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function fetchOrgStructurePurok($status) {
			$data = null;
			$query = "SELECT * FROM org_structure WHERE status = ?  AND purok_no<>'' ORDER BY position ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function editHead($name, $id) {
			$query = "UPDATE content_management SET brgy_head = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $name, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function editHeadImage($name, $id) {
			$query = "UPDATE content_management SET brgy_head_pic = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $name, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function editLogo($name, $prev) {
			$query = "UPDATE web_details SET web_icon = ? WHERE web_icon = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ss', $name, $prev);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function addRequest($resident_id, $request_type, $purpose) {
			$query = "INSERT INTO request (resident_id, request_type, purpose, date_issued, status) VALUES (?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$status = 2;

				$stmt->bind_param('iissi', $resident_id, $request_type, $purpose, $date, $status);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function addRequest2($resident_id, $request_type, $business_name, $purpose) {
			$query = "INSERT INTO request (resident_id, request_type, business_name, purpose, date_issued, status) VALUES (?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$status = 2;

				$stmt->bind_param('iisssi', $resident_id, $request_type, $business_name, $purpose, $date, $status);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function addWalkInRequest($orno, $resident_id, $request_type, $purpose) {
		    $query = "INSERT INTO request (orno, resident_id, request_type, purpose, date_issued, date_pickup, status, status2) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		    
		    if ($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$date_pickup = date("Y-m-d");
				$status = 10;
				$status2 = 'Processing';

				$stmt->bind_param('siisssis', $orno, $resident_id, $request_type, $purpose, $date, $date_pickup, $status, $status2);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function addWalkInRequest2($orno, $resident_id, $request_type, $business_name, $purpose) {
		    $query = "INSERT INTO request (orno, resident_id, request_type, business_name, purpose, date_issued, date_pickup, status, status2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    
		    if ($stmt = $this->conn->prepare($query)) {
				$date = date("Y-m-d H:i:s");
				$date_pickup = date("Y-m-d");
				$status = 10;
				$status2 = 'Processing';

				$stmt->bind_param('siissssis',$orno, $resident_id, $request_type, $business_name, $purpose, $date, $date_pickup, $status, $status2);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function fetchRequests() {
			$data = null;

			$query = "SELECT a.*, b.fname, b.mname, b.lname, b.address, b.address2, b.resident_since, b.civil_status, b.id AS resident_id FROM request AS a INNER JOIN residents AS b ON a.resident_id = b.id WHERE a.status = 2 ORDER BY a.id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}   
    
        public function fetchPendingHistory($status) {
			$data = null;

			$query = "SELECT a.*, a.status as request_status, b.email, b.prof_pic, b.fname, b.mname, b.lname, b.address, b.address2, b.address3, b.resident_since, b.contact_number, b.civil_status, b.id AS resident_id FROM request AS a INNER JOIN residents AS b ON a.resident_id = b.id WHERE a.status = '$status' AND NOT status2 = 'Picked Up' OR a.status = '2' ORDER BY a.id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function countRequestsHistory() {
			$data = null;

			$query = "SELECT COUNT(*) as total from request";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function fetchRequestsHistory($status) {
			$data = null;

			$query = "SELECT a.*, a.status as request_status, b.prof_pic, b.fname, b.mname, b.lname, b.address, b.address2, b.address3, b.resident_since, b.civil_status, b.id AS resident_id FROM request AS a INNER JOIN residents AS b ON a.resident_id = b.id WHERE NOT a.status = '$status' ORDER BY a.id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function fetchRequestsHistory2($id, $request_type) {
			$data = null;

			$query = "SELECT a.*, b.fname, b.mname, b.lname, b.address, b.address2, b.resident_since, b.civil_status, b.id AS resident_id FROM request AS a INNER JOIN residents AS b ON a.resident_id = b.id WHERE a.resident_id = ? AND a.request_type = ? ORDER BY a.id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $id, $request_type);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function pendingRequestChecker($id, $request_type) {
			$data = null;

			$query = "SELECT * FROM request WHERE resident_id = ? AND request_type = ? AND status = 2 LIMIT 1";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $id, $request_type);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function updateRequestStatus($status, $id) {
			$query = "UPDATE request SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function approveRequest($date_pickup, $status, $id) {
			$query = "UPDATE request SET date_pickup = ?, status = ?, status2 = 'Processing' WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('sii', $date_pickup, $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function changeRequestStatus($status, $id) {
			$query = "UPDATE request SET status2 = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function updateAdminProfile($name, $contact, $id) {
			$query = "UPDATE admin SET name = ?, contact = ? WHERE id = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssi', $name, $contact, $id);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function changePassword($id, $pword, $newpword) {
			$query = "SELECT id, pword FROM admin WHERE id = ? LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $id);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
							$sql = "UPDATE admin SET pword = ? WHERE id = ?";
							if ($ya = $this->conn->prepare($sql)) {
								$ya->bind_param("si", $newpword, $id);
								$ya->execute();
								$ya->close();
								echo "<script>alert('Password has been changed!');window.open('settings','_self');</script>";
								exit();
							}
						}
						else {
							echo "<script>alert('Incorrect Current Password');</script>";
						}
					}
				}

				else {
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		public function changePasswordOrgStructure($id, $pword, $newpword) {
			$query = "SELECT id, password FROM org_structure WHERE id = ? LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
							$sql = "UPDATE org_structure SET password = ? WHERE id = ?";
							if ($ya = $this->conn->prepare($sql)) {
								$ya->bind_param("si", $newpword, $id);
								$ya->execute();
								$ya->close();
								echo "<script>alert('Password has been changed!');window.open('settings','_self');</script>";
								exit();
							}
						}
						else {
							echo "<script>alert('Incorrect Current Password');</script>";
						}
					}
				}

				else {
				}
				$stmt->close();
			}
			$this->conn->close();
		}

		public function changeResidentPassword($id, $pword, $newpword) {
			$query = "SELECT id, password FROM residents WHERE id = ? LIMIT 1";
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $id);
				$stmt->execute();
				$stmt->bind_result($id, $hashed_pass);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						if (password_verify($pword, $hashed_pass)) {
							$sql = "UPDATE residents SET password = ? WHERE id = ?";
							if ($ya = $this->conn->prepare($sql)) {
								$ya->bind_param("si", $newpword, $id);
								$ya->execute();
								$ya->close();
								echo "<script>alert('Password has been changed!');window.open('homepage','_self');</script>";
								exit();
							}
						}
						else {
							echo "<script>alert('Incorrect Current Password');</script>";
							// if (empty($_SESSION['rlattempt'])) {
							// 	$_SESSION['rlattempt'] = 1;
							// }
							
							// else {
							// 	switch ($_SESSION['rlattempt']) {
							// 		case 1:
							// 			$_SESSION['rlattempt']++;
							// 			break;
							// 		case 2:
							// 			$_SESSION['rlattempt']++;
							// 			break;
							// 		case 3:
							// 			$_SESSION['rlattempt']++;
							// 			break;
							// 		case 4:
							// 			$_SESSION['rlattempt']++;
							// 			break;
							// 		default:
							// 			unset($_SESSION['rlattempt']);
							// 			setcookie('rrlimited', '5', time() + (30), "/");
							// 			echo "<script>alert('Reached limit!')</script>";
							// 	}
							// }
						}
					}
				}

				else {
				}
				$stmt->close();
			}
			$this->conn->close();
		}

		public function fetchIdCounter() {
			$query = "SELECT id FROM id_counter ORDER BY id DESC";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$stmt->bind_result($id_counter);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						return $id_counter;
					}
				}
				else {
					return false;
				}
				$stmt->close();
			}
			$this->conn->close();
		}

		public function updateIdCounter() {
			$query = "INSERT INTO id_counter (id) VALUES (NULL)";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$stmt->close();
			}
		}

		public function deleteAnnouncements($status, $category) {
			$query = "DELETE FROM announcements WHERE status = ? AND category = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("ii", $status, $category);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function deleteAllOrgStructure($status) {
			$query = "DELETE FROM org_structure WHERE status = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $status);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function insertContactNumber($contact) {
			$query = "INSERT INTO contact (contact_num) VALUES (?)";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $contact);
				$stmt->execute();
				$stmt->close();
			}
		}

		public function fetchContactNumbers() {
			$data = null;
			$query = "SELECT * FROM contact";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function deleteContactNumber($id) {
			$query = "DELETE FROM contact WHERE id = ?";

			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function verifyResidentAccount($id) {
			$query = "UPDATE residents SET email_verif = '1', verified = '1' WHERE id = ?";
			
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function insertReply($id, $reply) {
		    $query = "INSERT INTO reply (inquiry_id, reply, date_sent) VALUES (?, ?, ?)";
		    
		    if($stmt = $this->conn->prepare($query)) {
		        $date = date("Y-m-d H:i:s");
		        
				$stmt->bind_param('iss', $id, $reply, $date);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function updateRepliedStatus($id) {
		    $query = "UPDATE inquiries SET replied = 1 WHERE id = ?";
		    
		    if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function fetchReplyDetails($id) {
		    $data = null;
		    
		    $query = "SELECT * FROM reply WHERE inquiry_id = ?";
		    
		    if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function verifiedChangePassword($id, $password) {
			$query = "UPDATE residents SET password = ? WHERE id = ?";
			
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $password, $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function updateResidentStatus($status, $id) {
		    $query = "UPDATE residents SET mortality = ? WHERE id = ?";
		    
		    if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $status, $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function fetchResidentDetails($id_number) {
		    $data = null;
		    
		    $query = "SELECT * FROM residents WHERE id_number = ?";
		    
		    if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('s', $id_number);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		//ADMIN NAV - BRGY CRUZ

		public function count_Announcements(){
			$data = null;
			$query = "SELECT SUM(IF(category = '0',1,0)) as announcements FROM announcements WHERE status = 1";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function count_Blotters(){
			$data = null;
			$query = "SELECT SUM(IF(status = '1',1,0)) as blotters FROM blotters";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function count_Family(){
			$data = null;
			$query = "SELECT COUNT(*) as family FROM residents WHERE family = 'Yes' ORDER BY lname ASC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function count_Indigent(){
			$data = null;
			$query = "SELECT COUNT(*) as indigent FROM residents WHERE income = '1' ORDER BY lname ASC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function count_Requests(){
			$data = null;
			$query = "SELECT SUM(IF(status = '1',1,0)) as capproved, SUM(IF(status = '10',1,0)) as capproved2, SUM(IF(status = '3',1,0)) as cdeclined, SUM(IF(status = '2',1,0)) as cpending FROM request";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function count_SpecialStatus(){
			$data = null;
			$query = "SELECT SUM(IF(special_status = '1',1,0)) as pwd, SUM(IF(special_status = '2',1,0)) as solo_partner, SUM(IF(special_status = '3',1,0)) as senior_citizen FROM residents WHERE status = 1";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function count_Residents(){
			$data = null;
			$query = "SELECT SUM(IF(status = '1',1,0)) as total_resident, SUM(IF(resident_status = 'Yes',1,0)) as total_voter, SUM(IF(verified = '1',1,0)) as verified, SUM(IF(verified = '0',1,0)) as n_verified, SUM(IF(status = '1',1,0)) as not_verified, SUM(IF(status = '2',1,0)) as pending, SUM(IF(gender = 'Male',1,0)) as male, SUM(IF(gender = 'Female',1,0)) as female, SUM(IF(civil_status = 'Single',1,0)) as single, SUM(IF(civil_status = 'Married',1,0)) as married, SUM(IF(civil_status = 'Divorced',1,0)) as divorced, SUM(IF(civil_status = 'Separated',1,0)) as separated, SUM(IF(civil_status = 'Widowed',1,0)) as widowed, SUM(IF(resident_status = 'PWD',1,0)) as pwd, SUM(IF(resident_status = 'Senior Citizen',1,0)) as sc, SUM(IF(resident_status = 'working',1,0)) as working, SUM(IF(resident_status = 'Single Parent',1,0)) as sp FROM residents WHERE status = 1";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function updateResidentPhoto($unique) {
			$query = "UPDATE residents SET prof_pic = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $unique, $_SESSION['sess2']);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		public function fetchResidents() {
		    $data = null;
		    
			$query = "SELECT * FROM residents WHERE status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
			    $status = 1;
			    
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			
			return $data;
		}
		
		public function fetchSpecifiedOrgStructure($id) {
		    $data = null;
		    
			$query = "SELECT * FROM org_structure WHERE id = ?";
			if ($stmt = $this->conn->prepare($query)) {
			    
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			
			return $data;
		}
		
		public function displayResidentsFiltered($purok, $gender, $civil_status, $voterStatus, $registeredOrNot, $status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE ".$purok."".$gender."".$civil_status."".$voterStatus."".$registeredOrNot."status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		
		public function displayResidentsStatus($special_status, $status) {
			$data = null;
			$query = "SELECT * FROM residents WHERE special_status = ? AND status = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ss', $special_status, $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayResidentsStatusGender($special_status, $status, $gender) {
			$data = null;
			$query = "SELECT * FROM residents WHERE special_status = ? AND status = ? AND gender = ? ORDER BY lname ASC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('sss', $special_status, $status, $gender);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}


		public function displayEquipments($status) {
			$data = null;
			$query = "SELECT * FROM equipments WHERE status = ? ORDER BY id DESC";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $status);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		public function updateEquipment($name, $brand, $quantity, $cond, $date_arrived, $date_added, $category, $service, $keywords, $edit_id) {
			$query = "UPDATE equipments SET name = ?, brand = ?, quantity = ?, cond = ?, date_arrived = ?, date_added = ?, category = ?, service = ?, keywords = ?  WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssissssssi', $name, $brand, $quantity, $cond, $date_arrived, $date_added, $category, $service, $keywords, $edit_id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function updateEquipmentPhoto($unique, $id) {
			$query = "UPDATE equipments SET photo = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $unique, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function updateEquipmentStatus($status, $id) {
			$query = "UPDATE equipments SET status = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $status, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function addEquipment($unique, $name, $qty, $brand, $date_arrived, $cond, $date_added, $status, $added_by, $service, $category, $keywords) {
			$query = "INSERT INTO equipments (photo, name, quantity, brand, date_arrived, cond, date_added, status, added_by, service, category, keywords) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssisssssisss', $unique, $name, $qty, $brand, $date_arrived, $cond, $date_added, $status, $added_by, $service, $category, $keywords);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function adconnorrow($equipment_id, $item_borrowed, $type, $name, $date, $status, $date_borrowed, $purpose, $contact, $address) {
			$query = "INSERT INTO borrow (equipment_id, qty, type, name, date, status, date_added, purpose, contact, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssssssssss', $equipment_id, $item_borrowed, $type, $name, $date, $status, $date_borrowed, $purpose, $contact, $address);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function updateBorrowStatus($status, $date_returned, $date_returned2, $id) {
			$query = "UPDATE borrow SET status = ?, date_returned = ?, date_returned2 = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('issi', $status, $date_returned, $date_returned2, $id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function updateEquipmentQty($new_qty, $date, $equipment_id) {
			$query = "UPDATE equipments SET quantity = ?, date_added = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('isi', $new_qty, $date, $equipment_id);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function addReport($equipment_id, $item_lost, $type, $name, $date_lost, $reason, $date_reported, $category, $address, $contact) {
			$query = "INSERT INTO report (equipment_id, item_lost, type, name, date_lost, reason, date_reported, category, address, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ssssssssss', $equipment_id, $item_lost, $type, $name, $date_lost, $reason, $date_reported, $category, $address, $contact);
				$stmt->execute();
				$stmt->close();

			}
		}

		public function displayBorrow() {
			$data = null;
			$query = "SELECT b.*, b.status as borrow_status, b.name as borrow_name, a.*, b.id as borrow_id FROM equipments AS a INNER JOIN borrow AS b ON a.id = b.equipment_id WHERE b.status = 1 ORDER BY b.date DESC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function displayBorrow2() {
			$data = null;
			$query = "SELECT b.*, b.status as borrow_status, b.name as borrow_name, a.*, b.id as borrow_id FROM equipments AS a INNER JOIN borrow AS b ON a.id = b.equipment_id WHERE b.status = 2 ORDER BY b.date DESC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function displayReports() {
			$data = null;
			$query = "SELECT b.*, b.name as report_name, b.category as report_category, a.*, b.id as bid, a.id as aid FROM equipments AS a INNER JOIN report AS b ON a.id = b.equipment_id ORDER BY b.date_lost DESC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function updateReportStatus($category, $equipment_id) {
			$query = "UPDATE report SET category = ? WHERE id = ?";

			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('si', $category, $equipment_id);
				$stmt->execute();
				$stmt->close();

			}
		}
		
		
		
		public function fetchEmailID($email) {
			$query = "SELECT email FROM residents WHERE email = ? AND status = 1 LIMIT 1";
			
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$stmt->bind_result($id);
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					if($stmt->fetch()) {
						return $id;
					}
				}
				else {
					return false;
				}
				$stmt->close();
			}
			$this->conn->close();
		}
		
		public function displayBasicProfile($email) {
			$data = null;
			$query = "SELECT * FROM residents WHERE email = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('s', $email);
				$stmt->execute();
				$result = $stmt->get_result();
				$num_of_rows = $stmt->num_rows;
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function verifiedChangePassword2($id, $password) {
			$query = "UPDATE residents SET password = ? WHERE email = ?";
			
			if($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ss', $password, $id);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		
		
		public function count_Solo($gender){
			$data = null;
			$query = "SELECT COUNT(*) as solo FROM residents WHERE special_status = '2' AND status = '1' AND gender = '$gender' ORDER BY lname ASC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		public function count_SC($gender){
			$data = null;
			$query = "SELECT COUNT(*) as seniorc FROM residents WHERE special_status = '3' AND status = '1' AND gender = '$gender' ORDER BY lname ASC";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function addHearing($case_id, $hearing_date) {
			$query = "INSERT INTO hearings (case_id, hearing_date) VALUES (?, ?)";
			$stmt = $this->conn->prepare($query);
			$stmt->execute([$case_id, $hearing_date]);
		}
		
		public function getHearingSchedules($case_id) {
			$query = "SELECT * FROM hearings WHERE case_id = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bind_param("i", $case_id);
			$stmt->execute();
			$result = $stmt->get_result(); 
		
			$schedules = [];
			while ($row = $result->fetch_assoc()) {
				$schedules[] = $row; 
			}
		
			return $schedules; 
		}

		public function addBlotters($resident_id, $brgy_case, $resident_complainant_id, $age, $gender, $address, $contact, $time, $date, $happened, $accusation_id, $witness, $date_filed, $narrative) {
			$query = "INSERT INTO blotters (resident_id, brgy_case, resident_complainant_id, age, gender, address, contact, time, date, happened, accusation_id, witness, date_filed, narrative, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
			if ($stmt = $this->conn->prepare($query)) {
				$status = 1;
				$stmt->bind_param('isisssssssisssi', $resident_id, $brgy_case, $resident_complainant_id, $age, $gender, $address, $contact, $time, $date, $happened, $accusation_id, $witness, $date_filed, $narrative, $status);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		// public function fetchAccusations() {
		// 	$data = null;
		
		// 	$query = "SELECT id, accusation FROM accusations ORDER BY accusation ASC";
		// 	if ($stmt = $this->conn->prepare($query)) {
		// 		$stmt->execute();
		// 		$result = $stmt->get_result();
		// 		$num_of_rows = $stmt->num_rows;
		// 		while ($row = $result->fetch_assoc()) {
		// 			$data[] = $row;
		// 		}
		// 		$stmt->close();
		// 	}
		
		// 	return $data;
		// }
	
		// Fetch all accusations as an associative array
// function fetchAccusations() {
//     $sql = "SELECT id, accusation FROM accusations";
//     $stmt = $this->pdo->query($sql);
//     $accusations = [];
//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $accusations[$row['id']] = $row['accusation'];
//     }
//     return $accusations;
// }
public function fetchAccusations() {
    $sql = "SELECT id, accusation FROM accusations";
    // Use MySQLi to prepare the query
    $result = $this->conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die('Query failed: ' . $this->conn->error);
    }

    $accusations = [];
    // Fetch all rows from the result set
    while ($row = $result->fetch_assoc()) {
        $accusations[$row['id']] = $row['accusation'];
    }

    return $accusations;
}

		
		
		public function checkAccusationExists($accusation_id) {
			$query = "SELECT COUNT(*) FROM accusations WHERE id = ?";
			
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $accusation_id);
				$stmt->execute();
				$stmt->bind_result($count);
				$stmt->fetch();
				$stmt->close();
				
				return $count > 0;
			}
			
			return false; 
		}
		
		public function addAccusation($accusation) {
			$query = "INSERT INTO accusations (accusation) VALUES (?)";
			
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('s', $accusation);  
				$stmt->execute();
				
				$accusation_id = $this->conn->insert_id;
				
				$stmt->close();
				
				return $accusation_id;
			}
			
			return false;
		}
		
		public function getLastInsertId() {
			return $this->conn->lastInsertId();
		}
		
		// public function displayBlotters($blot_status) {
		// 	$data = null;
		// 	$query = "SELECT a.*, b.*, b.id as blotter_id FROM residents AS a INNER JOIN blotters AS b ON a.id = b.resident_id WHERE b.status = ?";
		// 	if ($stmt = $this->conn->prepare($query)) {
		// 		$stmt->bind_param('i', $blot_status);
		// 		$stmt->execute();
		// 		$result = $stmt->get_result();
		// 		$num_of_rows = $stmt->num_rows;
		// 		while ($row = $result->fetch_assoc()) {
		// 			$data[] = $row;
		// 		}
		// 		$stmt->close();
		// 	}
		// 	return $data;
		// }

		public function displayBlotters($blot_status) {
			$data = null;
			$query = "
				SELECT a.*, b.*, c.accusation, b.id AS blotter_id
				FROM residents AS a
				INNER JOIN blotters AS b ON a.id = b.resident_id
				LEFT JOIN accusations AS c ON b.accusation_id = c.id
				WHERE b.status = ?
			";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $blot_status);
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}
		
		public function displayBlotterDetails($id, $blot_status) {
			$data = null;
			$query = "
			SELECT a.*, b.*, c.accusation, b.id AS blotter_id
				FROM residents AS a
				INNER JOIN blotters AS b ON a.id = b.resident_id
				LEFT JOIN accusations AS c ON b.accusation_id = c.id
				WHERE b.status = ? AND b.id = ?
			";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('ii', $blot_status, $id); 
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				$stmt->close();
			}
			return $data;
		}

		
		
		public function addNonResidentComplainant($non_resident_complainant) {
			$query = "INSERT INTO external_complainants (non_resident_complainant) VALUES (?)";
		// 	$result = $this->conn->query($query);
		
		// 	if ($result) {
		// 		return $this->conn->insert_id; // Return the ID of the newly inserted record
		// 	}
		
		// 	return false; // Return false if the operation fails
		// }	
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('s', $non_resident_complainant);  
				$stmt->execute();
				
				$resident_complainant_id = $this->conn->insert_id;
				
				$stmt->close();
				
				return $accusation_id;
			}
			
			return false;
		}
		
		// public function checkResidentComplainantExists($id) {
		// 	$query = "SELECT COUNT(*) FROM residents WHERE id = " . (int)$id;
		// 	$result = $this->conn->query($query);
		
		// 	if ($result) {
		// 		$row = $result->fetch_row();
		// 		return $row[0] > 0; // Return true if the resident exists
		// 	}
		
		// 	return false; // Return false if the query fails
		// }
		public function checkResidentComplainantExists($id) {
			$query = "SELECT COUNT(*) FROM external_complainants WHERE id = ?";
			if ($stmt = $this->conn->prepare($query)) {
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$stmt->bind_result($count);
				$stmt->fetch();
				$stmt->close();
				return $count > 0;
			}
			return false;
		}

		
		// public function checkResidentComplainantExists($id) {
		// 	$query = "SELECT COUNT(*) FROM external_complainants WHERE id = ?";

		// 	if ($stmt = $this->conn->prepare($query)) {
		// 		$stmt->bind_param('i', $resident_complainant_id);
		// 		$stmt->execute();
		// 		$stmt->bind_result($count);
		// 		$stmt->fetch();
		// 		$stmt->close();
		// 		return $count > 0;
		// 	}
		// 	return false;
		// }


		// public function checkAccusationExists($accusation_id) {
		// 	$query = "SELECT COUNT(*) FROM accusations WHERE id = ?";
			
		// 	if ($stmt = $this->conn->prepare($query)) {
		// 		$stmt->bind_param('i', $accusation_id);
		// 		$stmt->execute();
		// 		$stmt->bind_result($count);
		// 		$stmt->fetch();
		// 		$stmt->close();
				
		// 		return $count > 0;
		// 	}
			
		// 	return false; 
		// }
		
			
		

public function addBenefits($benefit_name, $description, $type, $eligibility_criteria, $start_date, $end_date) {
	
	$query = "INSERT INTO benefits (benefit_name, description, type, eligibility_criteria, start_date, end_date, status) 
						VALUES (?, ?, ?, ?, ?, ?, ?)";
	if ($stmt = $this->conn->prepare($query)) {
			$status = 1;
			$stmt->bind_param('sssssss', $benefit_name, $description, $type, $eligibility_criteria, $start_date, $end_date, $status);
			$stmt->execute();
			$stmt->close();
}
}

// public function getAllBenefits() {
// 	$query = "SELECT * FROM benefits";
// 	$stmt = $this->conn->prepare($query);
// 	$stmt->execute();
// 	$result = $stmt->get_result();

// 	$benefits = [];
// 	while ($row = $result->fetch_assoc()) {
// 			$benefits[] = $row;
// 	}

// 	return $benefits;
// }

public function getAllBenefits($benefit_status) {
	
	$query = "SELECT * FROM benefits WHERE status = ?";
	$stmt = $this->conn->prepare($query);
	
	if (!$stmt) {
			error_log("Error preparing statement: " . $this->conn->error);
			return null; 
	}

	$stmt->bind_param('i', $benefit_status);
	$stmt->execute();
	$result = $stmt->get_result();

	$benefits = [];
	while ($row = $result->fetch_assoc()) {
			$benefits[] = $row;
	}

	$stmt->close();
	return $benefits;
}

public function editBenefits($benefit_name, $description, $type, $eligibility_criteria, $start_date, $end_date, $id)
{
    $query = "UPDATE benefits SET benefit_name = ?, description = ?, type = ?, eligibility_criteria = ?, start_date = ?, end_date = ? WHERE id = ?";

    if ($stmt = $this->conn->prepare($query)) {
        $stmt->bind_param('ssssssi', $benefit_name, $description, $type, $eligibility_criteria, $start_date, $end_date, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false;
        }
    } else {
        error_log("Error preparing statement: " . $this->conn->error);
        return false;
    }
}

public function archiveBenefit($status, $id)
{
    $query = "UPDATE benefits SET status = ? WHERE id = ?";

    if ($stmt = $this->conn->prepare($query)) {
        $stmt->bind_param('ii', $status, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; 
        } else {
            error_log("Error executing statement: " . $stmt->error);
            $stmt->close();
            return false; 
        }
    } else {
        error_log("Error preparing statement: " . $this->conn->error);
        return false; 
    }
}

public function changeBenefitStatus2($status, $id) {
	$query = "UPDATE benefits SET benefit_status = ? WHERE id = ?";

	if ($stmt = $this->conn->prepare($query)) {
		
			$stmt->bind_param('si', $status, $id);
			if ($stmt->execute()) {
			
			} else {
					echo "Error updating status.";
			}
			
			$stmt->close();
	} else {
			echo "Error: Could not prepare statement.";
	}
}

}


	
?>


