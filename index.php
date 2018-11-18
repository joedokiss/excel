<?php

require_once 'vendor/autoload.php';

use Senhung\Config\Configuration;

try{
	/* Initialize config array in Configuration class */
	Configuration::initializeConfigs('', false, 'separator');

	/* Read config APP_NAME */
	echo Configuration::read('APP_NAME') . "\n";

	/* Read config VERSION */
	echo Configuration::read('VERSION') . "\n";

	/* Set APP_NAME to config-write */
	Configuration::set('DATABASE', 'MySQL');
}catch(\Exception $e){
	echo $e->getMessage();
}
