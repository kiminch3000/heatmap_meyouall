<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	// 폴더명 지정
	// $dir = "/home/www/foo/test_folder_name";

	include "data_connect.php";

	$save_table="CCTV_01";
	$dir = "./".$save_table."/";
	$creat_tbl="
		CREATE TABLE `$save_table` (
		`no` int(15) NOT NULL,
		`serial_no` int(9) NOT NULL,
		`area_id` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
		`date_i` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
		`time_i` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`object_type` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`object_id` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`position_x` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`position_y` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`pin_x` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
		`pin_y` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	";
	mysqli_query($connect,$creat_tbl);

	// 핸들 획득
	$handle = opendir($dir);
	 
	$files = array();
	 
	// 디렉터리에 포함된 파일을 저장한다.
	while (false !== ($filename = readdir($handle))) {
		if($filename == "." || $filename == ".."){
			continue;
		}
		// 파일인 경우만 목록에 추가한다.
		$file_path=$dir . "/" . $filename;
		if(is_file($file_path)){
			$files[] = $filename;
			$save_path=$file_path;
			include "data_input.php";
		}
	}
	// 핸들 해제 
	closedir($handle);
	 
	// 정렬, 역순으로 정렬하려면 rsort 사용
	sort($files);
	 
	// 파일명을 출력한다.
	foreach ($files as $f) {
		echo $f;
		echo "<br />";
	}
	echo "OK";
