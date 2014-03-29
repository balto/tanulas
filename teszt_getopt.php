#!/usr/bin/env php
<?php

$short = array("h", "v");
$long = array("file=", "help", "v=");

$ret = getOptions(null, $short, $long);

print_r($ret);

function getOptions($defaultOpt, $shortOptions, $longOptions) {
	require_once "Console/Getopt.php";
	$con = new Console_Getopt();
	$args = Console_Getopt::readPHPArgv();
	$ret = $con->getopt($args, $shortOptions, $longOptions);
	$opts = array();

	foreach ($ret[0] as $arr) {
		$rhs = ($arr[1] !== null) ? $arr[1] : true;

		if (array_key_exists($arr[0], $opts)) {
			if (is_array($opts[$arr[0]])) {
				$opts[$arr[0]][] =  $rhs;
			}
			else {
				$opts[$arr[0]] = array($opts[$arr[0]], $rhs);
			}
		}
		else {
			$opts[$arr[0]] = $rhs;
		}
	}

	if (is_array($defaultOpt)) {
		foreach ($defaultOpt as $k => $v) {
			if (!array_key_exists($k, $opts)) {
				$opts[$k] = $v;
			}
		}
	}

	return $opts;
}

?>
