#!/usr/bin/env php
<?php
$lineno = 1;

while (($line = fgets(STDIN)) != FALSE) {
	fputs(STDOUT, "{$lineno} {$line}");
	$lineno++;
}
?>
