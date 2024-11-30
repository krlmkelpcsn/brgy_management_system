<?php
//error_reporting(0);

if (!isset($_SESSION)) {
    session_start();
}

function db_connect()
{

      $hostname = "localhost";
   
    $dbname = "brgy_pobla";
    $username = "root";
    $password = "";

    $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function db_get_result($tableName, $column, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $value = "";
    $array = array();

    foreach ($where as $key => $values) {
        $stringWhere .= $key . "= '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }

    $stringWhere = substr($stringWhere, 0, -4);
    $query = "SELECT " . $column . " FROM " . $tableName . " WHERE " . $stringWhere;

    try {
        $sth = $db->query($query);
        if (!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $value = $row[$column];

        } else $value = "";
    } catch (PDOException $e) {

    }

    return $value;
}

function db_update($tableName, $data, $where)
{
    $db = db_connect();
    $stringValues = "";
    $stringWhere = "";
    $array = array();

    foreach ($data as $key => $value) {
        $stringValues .= $key . " = :" . $key . ",";
        $array[":" . $key] = $value;
    }

    foreach ($where as $key => $values) {
        $stringWhere .= $key . "= :" . $key . " AND ";
        $array[":" . $key] = $values;
    }

    $boolean = "";
    $stringWhere = substr($stringWhere, 0, -4);
    $stringValues = substr($stringValues, 0, -1);
    $query = "UPDATE $tableName SET " . $stringValues . " WHERE " . $stringWhere;


    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = true;
    } catch (PDOException $e) {
        $boolean = false;
    }

    return $boolean;
}

function db_insert($tableName, $data)
{
    $db = db_connect();
    $stringValues = "";
    $stringInit = "";
    $stringParam = "";
    $array = array();
    foreach ($data as $key => $value) {
        $stringInit .= $key . ",";
        $stringValues .= ":" . $key . ",";
        $array[":" . $key] = $value;
    }
    $boolean = "";
    $stringInit = substr($stringInit, 0, -1);
    $stringValues = substr($stringValues, 0, -1);
    $query = "INSERT INTO $tableName (" . $stringInit . ") VALUES(" . $stringValues . ")";
    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = $db->lastInsertId();

    } catch (PDOException $e) {
        $boolean = $e;
    }

    return $boolean;
}

function db_delete($tableName, $data)
{
    $db = db_connect();
    $stringWhere = "";

    $array = array();

    foreach ($data as $key => $values) {
        $stringWhere .= $key . "= :" . $key . " AND ";
        $array[":" . $key] = $values;
    }

    $boolean = "";
    $stringWhere = substr($stringWhere, 0, -4);
    $query = "DELETE FROM $tableName WHERE " . $stringWhere;

    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = true;
    } catch (PDOException $e) {
        $boolean = $e;
    }

    return $boolean;
}

function isExists($tableName, $where)
{
    $db = db_connect();
    $boolean = "";
    $where_string = "";
    foreach ($where as $key => $values) {
        $where_string .= $key . "= '" . $values . "' AND";
    }
    $where_string = substr($where_string, 0, -4);

    try {
        $query = "SELECT * FROM $tableName WHERE " . $where_string;
        $sth = $db->query($query);
        if ($sth->rowCount() > 0) $boolean = true;
        else $boolean = false;
    } catch (PDOException $e) {
        $boolean = false;
    }

    return $boolean;
}

function db_response($query)
{
    if ($query) echo json_encode(array('success' => true)); else echo json_encode(array('success' => false));
}

function db_select($tableName, $orderby)
{
    $db = db_connect();
    $query = "SELECT * FROM $tableName $orderby";
    $value = $db->query($query);
    return $value;
}

function db_select_by_id($tableName, $where)
{
    $db = db_connect();
    $query = "SELECT * FROM $tableName WHERE " . $where;
    $value = $db->query($query);
    return $value;
}

function db_select_where($tableName, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $array = array();

    foreach ($where as $key => $values) {
        $stringWhere .= $key . " = '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }
    $stringWhere = substr($stringWhere, 0, -4);

    $query = "SELECT * FROM $tableName  WHERE $stringWhere";
    $value = $db->query($query);
    return $value;
}

function db_error($e)
{
    echo json_encode(array("success" => false, "message" => $e));
}

function db_count($tableName, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $array = array();
    $count = 0;

    foreach ($where as $key => $values) {
        $stringWhere .= $key . " = '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }
    $stringWhere = substr($stringWhere, 0, -4);
    $query = "SELECT COUNT(*) as n FROM $tableName WHERE $stringWhere";
    try {
        $sth = $db->query($query);
        if (!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $count = $row['n'];
        }
    } catch (Exception $e) {
        $count = 0;
    }

    return $count;
}

//My Function
function my_query($qry)
{
    $db = db_connect();
    $query = $qry;
    $value = $db->query($query);
    return $value;
}

function peso_format($amount)
{
    $amount = number_format($amount, 2, ".", ","); // returns: 1,23
    if ($amount == '0.00') {
        $amount = "";
    }
    //$amount = "<a class='text-align: right;'>".$amount."</a>";

    return $amount;
}

function format_date($val)
{
    if ($val <> '') {
        $val = date('M. d, Y ', strtotime($val));
    }
    return $val;
}

function format_time($val)
{
    if ($val <> '') {
        $val = date('g:i A', strtotime($val));
    }
    return $val;
}

function format_datetime($val)
{
    if ($val <> '') {
        $val = date('M. d, Y g:i A', strtotime($val));
    }
    return $val;
}

function status($x)
{
    if ($x == 'Pending') {
        $status = 'info';
    } elseif ($x == 'Approved') {
        $status = 'warning';
    } elseif ($x == 'Completed') {
        $status = 'success';
    } elseif ($x == 'Cancelled') {
        $status = "danger";
    } else {
        $status = 'default';
    }
    return " <span class='label label-$status'> $x </span> ";
}

function addSpace($no)
{
    $data = '';
    for ($i = 0; $i < $no; $i++) {
        $data = $data . "&nbsp;";
    }
    return $data;
}


//Declaration
$db = db_connect();
date_default_timezone_set('Asia/Manila');
$dateTimeNow = date('Y-m-d h:i:sa');
$dateNow = date('Y-m-d');

//Change
 $system_title = "";
$shortTitle = "";
$server_email = "";
$defaultPassword = '';
//Main
$mainUser = 'Customer';
$tbl = 'tbl_customers';
$mainUserNo = 'customerNo';

(isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : '');
(isset($_SESSION['role']) ? $user_role = $_SESSION['role'] : '');


function autoGenUniqueNo($tbl, $no)
{
    $db = db_connect();
    $query = "SELECT $no FROM $tbl ORDER BY $no DESC LIMIT 1";
    try {
        $sth = $db->query($query);
        if (!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $genNo = $row[$no] + $one = 1;
        }
    } catch (Exception $e) {
        $genNo = date("Y") . '1';
    }

    return $genNo;
}

function autoGenNo($cat)
{
    if($cat=='ORNo'){
        $val = strtoupper(substr(md5(mt_rand()), 0, 11));
    }else{
        $val = strtoupper(substr(md5(mt_rand()), 0, 7));
    }
    return $val;
}

function ualt($action)
{
    $data = array("user_id" => $_SESSION['user_id'], "type" => $_SESSION['role'], "action" => $action);
    $query = db_insert('tbl_ualt', $data);
}

function rand_strInt($length, $x)
{
    if ($x == 's') {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    } else {
        $chars = "0123456789";
    }
    return substr(str_shuffle($chars), 0, $length);
}


(isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : $user_id=1);

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == $mainUser) { //For main user only
        $user_id=$_SESSION['user_id'];
        $strW = " WHERE reg_id='$user_id'";
        $strA = " AND reg_id='$user_id'";
    } else {

       
    }
}

 (isset($_SESSION['dental_id']) ? $dental_id = $_SESSION['dental_id'] : $dental_id=1);
       // $dental_id=$_SESSION['dental_id'];
        $strW = " WHERE dental_id='$dental_id'";
        $strA = " AND dental_id='$dental_id'";
        
function endecrypt($string, $action = 'e')
{
    $_SESSION['key'] = 'imBlessed@o1';
    $secret_key = $_SESSION['key'];
    $secret_iv = $_SESSION['key'];

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;


   // return $string;
}


//$subject = "FROM :   $title New Account Created";
//$txt = "Your username :  $username  and password : $password. You can now login.";
//$to = $username;
//$from = "@phsite.tech";
//$headers = "From:" . $from;
//mail($to, $subject, $txt, $headers);

function dateBefore($date){
    $date1=date_create(date('Y-m-d'));
    $date2=date_create($date);
    $diff=date_diff($date1,$date2);
    $res= $diff->format("%R%a days");
    return $res;
}

function itexmo($number,$message)
{

	$ch = curl_init();
	$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-JOSHU120259_MKX1Z', 'passwd' => 'cn]%y6t!$f');
	curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($itexmo));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec ($ch);
	curl_close ($ch); 

}

$termsCondi = '';

function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..
    return false;
}


function getInfoRes($id)
{
    
    $name = db_get_result('residents', "CONCAT(fname , ' ', lname)", ['id' => $id]);
    return $name;
}

function sendSMS($number,$message){
    $ch = curl_init();
    $parameters = array(
        'apikey' => '47ea13bb9f644a5c8b9950fb6d917bb2', //Your API KEY
        'number' => $number,
        'message' => $message,
        'sendername' => 'SystemSaid'
    );
    curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
    curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close ($ch);

//Show the server response
    echo $output;
}


function dob ($birthday){
    list($day,$month,$year) = explode("/",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
    $year_diff--;
    return $year_diff;
    }

?>