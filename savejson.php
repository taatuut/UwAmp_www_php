<?php
set_time_limit(5);
// Receives Dynatrace PureLytics JSON stream input. Does it matter if it comes from POST or PUT or ...?
$input = @file_get_contents('php://input');
$pf = '/uem/';
$xt = '.txt';
$ct = 'text/plain';
// TODO: facilitate multiple collection tags in array
$cl = 'rw';
$tr = strval(time().rand());
$rawname = $pf.$cl.$tr;
// Writes input to one file. Make sure path exist of it fails. Or use better checks :-)
//writeData($input, 'C:\\Temp\\Dropbox\\Dynatrace\\UwAmp\\www\\rawdata\\'.$tr.$xt);
// send to MarkLogic
httpSender($input,$rawname.$xt,$cl,$ct);

// Create array from incoming json. CHR(10) as splitter is specific character for Windows Dynatrace Purelytics stream?? Check splitter for Linux / OS independent.
$jsons = explode(CHR(10), $input);

$i = 0;
$xt = '.json';
$ct = 'application/json';
$cl = 'data';
foreach ($jsons as &$json) {
	// Writes separate file for each line / json object. Make sure path exist or it fails. Or use better checks :-)
	//writeData($json, 'C:\\Temp\\Dropbox\\Dynatrace\\UwAmp\\www\\json\\'.$doc);
	// send to (MarkLogic
	$docname = $rawname.$cl.$i.$xt;
	httpSender($json,$docname,$cl,$ct);
	$i++;
}

// change(d) default authentication for HTTP Server from digest/digestbasic to basic in MarkLogic
function httpSender($data,$doc,$cl,$ct) {
	$strlen =  strlen($data);
	preg_match("/(?<=\"visitTag\":\")(.*?)(?=\",)/", $data, $output_array);
	if (count($output_array) > 0) {
		$visitTag = $output_array[0];
		if (strlen($visitTag) > 0) {
			// use key 'http' even if you send the request to https://...
			$url = 'http://127.0.0.1:8040/v1/documents?uri='.$doc.'&collection='.$cl.'&perm:puppy-role=read'.'&transform=crmenrich&trans:name='.$visitTag;
			// '&collection='.$cl.'&perm:puppy-role=read'.
			//$url = 'http://127.0.0.1:8040/v1/documents?uri='.$doc.'&transform=crmenrich&trans:name='.$visitTag;
			// PUT is required for MarkLogic REST API since ...?
			$options = array(
				'http' => array(
					'header'  => "Content-Length: ".$strlen."\r\n".
						"Content-type: ".$ct."\r\n".
						"Authorization: Basic ".base64_encode("admin:admin")."\r\n",
					'method'  => 'PUT',
					'content' => $data,
				),
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			//if ($result === FALSE) { /* Handle error */ }
			return var_dump($result);
		}
	}
}

function writeData($fdata, $fname) {
	$er = 'Could not create file: ';
	// no proper folder check yet so will die if folder does not exist
	$fh = fopen($fname, 'w') or die($er.$fname);
	$fwrite = fwrite($fh, $fdata);
	fclose($fh);
}
?>
