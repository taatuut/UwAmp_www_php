<?php

// Provides CRM data based on the unique user id

include "includes/Array2XML.php";

function my_static_number($a, $b, $str) {
    $hash = substr(hash('crc32', $str), 0, 2); // effectively produces a number between 0 and 255
    $dec = hexdec($hash);
    $base = $b + 1 - $a;
    return $a + $dec % $base;
}

function getAge($str) {
	$minage = 18;
	$maxage = 105;
	return my_static_number($minage,$maxage,$str);
}

function getLat($str) {
	$minage = 50.7 * 100;
	$maxage = 53.6 * 100;
	return my_static_number($minage,$maxage,$str) / 100;
}

function getLon($str) {
	$minage = 3.6 * 100;
	$maxage = 7.1 * 100;
	return my_static_number($minage,$maxage,$str) / 100;
}

function getGender($int) {
	$gender = "F";
	if ($int % 2 == 0) {
		$gender = "M";
	}	
	return $gender;
}

function getIncome($age,$gender) {
	$income = $age * 1234;
	if ($gender == "F") {
		$income = $income * 2;
	}	
	return $income;
}

function getLocation($name) {
	$lat = getLat($name);
	$lon = getLon($name);
	//return array("lat" => $lat, "lon" => $lon);
	return implode('%20', array(strval($lat),strval($lon)));
}

function getTrans($value, $key) {
	echo '&trans:'.$key.'='.$value;
}

function createOutput($array,$format) {
	$output = json_encode($array);
	if ($format == "xml") {
		Array2XML::init('1.0','UTF-8'); // version, encoding
		$xml = Array2XML::createXML('crm', $array); // root node, data array
		$output = $xml->saveXML();
	}
	if ($format == "csv") {
		$file = fopen('php://temp/maxmemory:'. (2*1024*1024), 'r+');
		fputcsv($file, $array);
		rewind($file);
		$output = stream_get_contents($file);
		fclose($file);
	}
	if ($format == 'trans') {
		$output = '';
		array_walk_recursive($array, 'getTrans');
	}
	return $output;
}

parse_str($_SERVER['QUERY_STRING']);
$array = array();
if (isset($name)) {
	$age = getAge($name);
	$gender = getGender($age);
	$income = getIncome($age,$gender);
	$lat = getLat($name);
	$lon = getLon($name);
	$location = getLocation($name);
	$array = array("name" => $name, "age" => $age, "gender" => $gender, "income" => $income, "location" => $location);
}
if (!isset($format)) {
	$format = "json";
}

echo createOutput($array,$format);
?>