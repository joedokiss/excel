<?php
namespace Lib;

require __DIR__.'/../vendor/autoload.php';

class Excel
{
	protected $_filePath = __DIR__.'/../tmp/';
	protected $_fileName;
	protected $_reader;
	protected $_activeSheet;
	protected $_totalColumns;
	protected $_totalRows;
	protected $_highestColumnIndex;
	protected $_spreadsheet;

	public function __construct($fileName){
		$this->_fileName = $fileName;

		if(!file_exists($this->_filePath.$this->_fileName)){
  			throw new \Exception('The file is not existed!');
  		}

  		$this->_reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
  		$this->_reader->setReadDataOnly(TRUE);
  		$this->_spreadsheet = $this->_reader->load($this->_filePath.$this->_fileName);
  		$this->_activeSheet = $this->_spreadsheet->getActiveSheet();
		$this->_totalRows = $this->_activeSheet->getHighestRow(); // 总行数
		$this->_totalColumns = $this->_activeSheet->getHighestColumn(); // 总列数
		$this->_highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($this->_totalColumns); // e.g. 5
	}//construct

	public function __get($property) {
	    if (property_exists($this, $property)) {
	      return $this->$property;
	    }
	  }

  	public function __set($property, $value) {
	    if (property_exists($this, $property)) {
	      $this->$property = $value;
	    }
	    return $this;
  	}

  	public function fileIsExisted($filePath, $fileName){
  		if(!file_exists($filePath.$fileName)){
  			return false;
  		}
  		return true;
  	}

  	public function hasData($ignoredRows = 2){
  		$lines = $this->_totalRows - $ignoredRows;

  		if ($lines <= 0) {
		    return false;
		}

		return true;
  	}
}//class