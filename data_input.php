<?php
	//$save_path="./test.xlsx";
	$sarr=array('A','B','C','D','E','F','G','H');
	require_once "./php_excel/Classes/PHPExcel/IOFactory.php";
	$objReader=PHPExcel_IOFactory::createReader('Excel2007');
	$inputFileType="Excel2007";
	$inputFileName=$save_path;
	$objReader=PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel=$objReader->load($inputFileName);
	$sheetData=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	for($ai=1;$ai<=count($sheetData);$ai++) {
		$a_query="insert into `$save_table`( `no`, `serial_no`, `area_id`, `date_i`, `time_i`, `object_type`, `object_id`, `position_x`, `position_y`, `pin_x`, `pin_y`)
			values(null
		";
		$excel_temp=$sheetData[$ai];
		for($bi=0;$bi<8;$bi++) {
			$i=$sarr[$bi];
			if(isset($excel_temp[$i])) {
				$excel_data=trim($excel_temp[$i]);
				$a_query.=", '$excel_data'";
				if($bi==6) {$position_x=$excel_data;} else {}
				if($bi==7) {$position_y=$excel_data;} else {}
			}
			else {
				$a_query.=", '-'";
			}
		}
		// Input : pin_x, pin_y
		//$pin_x=((double)$position_x/480)*50;
		//$pin_y=$position_y;
		$a_query.=", '1', '1');";
		if($ai==1) {
			//
		}
		else {
			mysqli_query($connect,$a_query);
		}
	}