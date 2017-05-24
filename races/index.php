<?php
// JSON API proxy
// only get a new list every $n minutes
$fn='/tmp/racesproxy';
$n=1;
if (file_exists($fn)) {
	$age = time() - filemtime();
	if ($age > 60*$n) {
		$races = file_get_contents('https://api.beta.tab.com.au/v1/tab-info-service/racing/next-to-go/races?jurisdiction=NSW');
		file_put_contents($fn, $races);
	}
	
	echo file_get_contents($fn);
}
