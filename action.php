<?php

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$query_params_unfiltered = array(
	"username" 			=> "username",
	"password"			=> "password",
	"from"				=> "TestSMS",
	"to"				=> "0400000001",
	"message"			=> "This is a test message"
//	"fname" 			=> ucwords(strtolower(clean_input($_POST['fname']))),
//	"lname" 			=> ucwords(strtolower(clean_input($_POST['lname']))),
//	"mobile" 			=> clean_input($_POST['mobile']),
);

// Filter out empty results
$query_params = array_filter($query_params_unfiltered);

$query = http_build_query($query_params);

$api_URL = "http://api.smsbroadcast.com.au/api.php?$query";

// echo $api_URL;
$ch = curl_init($api_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

// Log request
//$timestamp = date('d/m/Y H:i');
//$logString = "$timestamp,";
//foreach($query_params_unfiltered as $k => $param) {
	//if($k == "token") continue;
	//if($param == "NA") $param = "";
	//$logString .= "$param,";
//}
//$logString .= "$result\n";

//$logFile = fopen("log.csv", "a");
//fwrite($logFile, $logString);
//fclose($logFile);

?>