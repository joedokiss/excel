<?php
namespace Facade;

class Facade
{
	//save Excel data into DB table
	public static function save($db, $excel, $table){

		self::refresh($db, $table);

		$sql = "INSERT INTO $table (`name`, `chinese`, `maths`, `english`) VALUES ";

		/*
		* $worksheet->getCellByColumnAndRow($col, $row)->getValue()可以获取表格中任意单元格数据内容
		* $col表示单元格所在的列，以数字表示，A列表示第一列
		* $row表示所在的行
		*/
		for ($row = 3; $row <= $excel->_totalRows; ++$row) {
		    $name = $excel->_activeSheet->getCellByColumnAndRow(1, $row)->getValue(); //姓名
		    $chinese = $excel->_activeSheet->getCellByColumnAndRow(2, $row)->getValue(); //语文
		    $maths = $excel->_activeSheet->getCellByColumnAndRow(3, $row)->getValue(); //数学
		    $english = $excel->_activeSheet->getCellByColumnAndRow(4, $row)->getValue(); //外语

		    $sql .= "('$name','$chinese','$maths','$english'),";
		}
		$sql = rtrim($sql, ","); //去掉最后一个,号

		if(!$db->query($sql)){
			throw new \Exception('DB save failed.');
		}

		return true;
	}//save

	//refresh the DB table
	public static function refresh($db, $table){
		$sql = "DELETE FROM $table";

		if(!$db->query($sql)){
			throw new \Exception('DB delete failed.');
		}

		return true;
	}//refresh
}