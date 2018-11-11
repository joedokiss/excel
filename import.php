<?php 
require 'vendor/autoload.php';

require_once __DIR__.'/lib/db.php';
require_once __DIR__.'/lib/Excel.php';
require_once __DIR__.'/facade/Facade.php';

try{
	// $fileName = $_POST[];
	$fileName = 'students.xlsx';
	$excel = new Lib\Excel($fileName);

	//shall read it from the config
	$foreignCurrencyRate = 5; //typically AUD : CNY
	$ignoredRows = 2; //how many rows shall be ignored in the Excel file

	if(!$excel->hasData($ignoredRows)){
		throw new \Exception('Excel表格中没有数据');
	}

	//save the data into the DB
	Facade\Facade::save($db, $excel, 't_student');

}catch(Exception $e){
	echo $e->getMessage();
}