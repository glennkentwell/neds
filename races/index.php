<?php
// JSON API proxy
// only get a new list every $n minutes

function update($filename) {
	$races = file_get_contents('https://api.beta.tab.com.au/v1/tab-info-service/racing/next-to-go/races?jurisdiction=NSW');
	file_put_contents($filename, $races);
}

$fn = "/tmp/racesproxy";
$n = 1;
if (file_exists($fn)) {
	$age = time() - filemtime($fn);
	if ($age > 60*$n) {
		update($fn);
	}
} else {
	update($fn);
}
echo file_get_contents($fn);


