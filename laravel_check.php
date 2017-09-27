<?php
/*

Author: Mindaugas Milius
Description: This php script should be called from shell script (laravel_check.php)
The Script checks if PHP version compatible with Laravel version and if all 
required modules are loaded
$laravel array should be always updated with newsest laravel releases manually

*/

//Do not edit this initial line! 
echo "########### LARAVEL CHECK ###########" . PHP_EOL;


if (isset($_GET['version'])) {
	$version = $_GET['version'];
	echo "[INFO] Laravel version: $version" . PHP_EOL;;
} else {
	echo "[ERROR] Error by entering your Laravel version" . PHP_EOL;
	echo "Exiting modules and php version test..." . PHP_EOL;
	die();
}

$success= true;
//Modules are all some for all Laravel versions
$required_modules = ['curl','tokenizer','mbstring','openssl','PDO','xml'];


$laravel= [
	"4.2" => ['php_min' => "5.4",	'php_max' => "5.7"], 
	"5.0" => ['php_min' => "5.4",	'php_max' => "7.0"], 
	"5.1" => ['php_min' => "5.5.9",	'php_max' => NULL], 
	"5.2" => ['php_min' => "5.5.9",	'php_max' => NULL], 
	"5.3" => ['php_min' => "5.6.3",	'php_max' => NULL], 
	"5.4" => ['php_min' => "5.6.4",	'php_max' => NULL], 
	"5.5" => ['php_min' => "7.0",	'php_max' => NULL], 
];

$php_v = phpversion();



	echo "[INFO] current running PHP version $php_v" . PHP_EOL;
	echo "[INFO] Laravel $version requirements is PHP => " . $laravel[$version]['php_min'];
	if ($laravel[$version]['php_max'] != NULL) {
		echo " and PHP < " .$laravel[$version]['php_max'];
	}
	echo PHP_EOL;

	




		if (version_compare($php_v, $laravel[$version]['php_min'], ">=")) { 
 		 // you're on 4.3.0 or later 
		if ($laravel[$version]['php_max'] != NULL) {
		 	if (version_compare($php_v, $laravel[$version]['php_max'], ">=")) {
		 		echo "[ERROR] WRONG PHP VERSION! (to high)" . PHP_EOL;
				$success= false;
		 	}
		 } 
		echo "[SUCCESS] PHP VERSION  OK!" . PHP_EOL; 	
	} else {
		echo "[ERROR] WRONG PHP VERSION! (to low)" . PHP_EOL; 
		$success= false;
	}


//load modules
$modules = get_loaded_extensions();
echo "[INFO] Required modules:  ". implode(', ', $required_modules)  . PHP_EOL;


// 4.2 version needs only mcrypt
if ($version = 4.2) {
		$missing_modules = array_diff(['mcrypt'],$modules);
} else {
		$missing_modules = array_diff($required_modules,$modules);
}




$missing_modules = array_diff($required_modules,$modules);   


if (!empty($missing_modules)) {
	foreach ($missing_modules as $misssing_module) {
	echo "[ERROR] $misssing_module> is missing!" . PHP_EOL;
	$success= false;
	}
} else {
	echo "[SUCCESS] All required modules are loaded!" .PHP_EOL;
}


if ($success) {
	echo "[SUCCESS] Check successfuly passed all tests!";
} else {
	echo "[ERROR] Check did not passed all tests!";
}

echo  PHP_EOL.PHP_EOL;
?>