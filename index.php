<?php

require_once 'vendor/autoload.php';

use Senhung\Config\Configuration;

try{
	/* Initialize config array in Configuration class */
	Configuration::initializeConfigs('.env', false, 'separator', __DIR__.'/');

	/* Read config APP_NAME */
	echo Configuration::read('APP_NAME') . "\n";

	/* Read config VERSION */
	echo Configuration::read('VERSION') . "\n";

}catch(\Exception $e){
	echo $e->getMessage();
}
