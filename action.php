<?php

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$message_life = "Life Message Here";
$message_fun = "Funeral Message Here";
$message_inc = "Income Message Here";

$query_product = $_POST["product"];

if ($query_product = "INC"){
	$message = $message_inc;
} elseif ($query_product = "LIFE"){
	$message = $message_life;
} else {
	$message = $message_fun;
}

$query_params_unfiltered = array(
	"username" 			=> "username",
	"password"			=> "password",
	"from"				=> "CompanyName",
	"to"				=> clean_input($_POST['mobile']),
	"message"			=> $message
);

// Filter out empty results
$query_params = array_filter($query_params_unfiltered);

$query = http_build_query($query_params);

$api_URL = "http://api.smsbroadcast.com.au/api.php?$query";

echo $api_URL;

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