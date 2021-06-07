<!doctype html>
<html>
	<head>
		<title>HEAT MAP</title>
		<style>
			* {
				border:0; margin:0; padding:0; line-height:100%;
				box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;
				text-align:left; line-height:100%;
				font-size:18px; font-family:'Malgun Gothic', sans-serif; color:#000;
			}
			body {margin:30px 33px;}
			h1 {margin:9px 0;}
			vobj {display:block; position:absolute; left:0px; top:0px; width:5px; height:100%; background-color:#ddd;}
			.area {border:#666 1px solid; width:1280px; height:100px; position:relative; margin:2px 0;}
			.clip {border:#666 1px solid; width:1280px; height:10px; position:relative; margin:2px 0;}
			.rect {display:inline-block; width:150px; height:60px; border:#333 1px solid; vertical-align:top; margin:0 6px 12px 0;}
			.rect p {text-align:center; line-height:150%; color:#fff;}
			.rect d {display:block; text-align:center; line-height:300%;}
			.map {
				width:1920px; height:1080px; border:#333 1px solid; position:relative;
				background-image:url('./MAP01.png');
				background-size:cover;
				margin:12px 0 0 0;
			}
			.road {position:absolute; width:150px; height:20px; background-color:pink;}
			#cctv_01_copy {left:570px; top:347px; transform: rotate(-16deg);} /*740-340  좌하*/
			#cctv_02_copy {left:718px; top:306px; transform: rotate(-16deg);} /*740-340  우상*/
			#cctv_03_copy {left:950px; top:240px; transform: rotate(-16deg);} /*970-260  우상*/
			#cctv_04_copy {left:1130px; top:182px; transform: rotate(-16deg);} /*1280-170  좌하*/
			#cctv_05_copy {left:1255px; top:240px; transform: rotate(48deg); width:200px;} /*1280-170  우하*/
			#cctv_06_copy {left:1524px; top:612px; transform: rotate(109deg);} /*1618-545  좌하*/
			#cctv_07_copy {left:1405px; top:747px; transform: rotate(19deg);} /*1555-773  좌상*/
			#cctv_08_copy {left:1456px; top:815px; transform: rotate(109deg);} /*1500-880  우상*/
			#cctv_09_copy {left:1037px; top:621px; transform: rotate(19deg);} /*1030-590  우하*/
			#cctv_10_copy {left:963px; top:647px; transform: rotate(109deg); width:100px;} /*1030-590  좌하*/
			#cctv_11_copy {left:884px; top:572px; transform: rotate(19deg); } /*1030-590  좌상*/
			#cctv_12_copy {left:982px; top:515px; transform: rotate(109deg);} /*1030-590  우상*/
			#cctv_13_copy {left:771px; top:581px; transform: rotate(109deg); width:100px;} /*835-533  좌하*/
			#cctv_14_copy {left:685px; top:500px; transform: rotate(19deg);} /*835-533  좌상*/
			#cctv_15_copy {left:793px; top:447px; transform: rotate(109deg);} /*835-533  우상*/
			#cctv_16_copy {left:634px; top:432px; transform: rotate(-16deg);} /*800-410  좌하*/
			#cctv_17_copy {left:785px; top:388px; transform: rotate(-16deg);} /*800-410  우상*/
			#cctv_18_copy {left:970px; top:334px; transform: rotate(-16deg);} /*1126-317  좌하*/
			#cctv_19_copy {left:1059px; top:263px; transform: rotate(74deg); width:110px;} /*1126-317  좌상*/
			#cctv_20_copy {left:1136px; top:284px; transform: rotate(-16deg);} /*1126-317  우상*/
		</style>
	</head>

	<body>
<?php
	include_once "data_connect.php";
		
	$tables="";
	$tables_query="SHOW TABLES;";
	$tables_result=mysqli_query($connect,$tables_query);
	$tables_num=mysqli_affected_rows($connect);
	for($i=0;$i<$tables_num;$i++) {
		$table_row=mysqli_fetch_array($tables_result);
		$table_name=$table_row[0];
		$cctv=str_replace("_copy","",$table_name);
		for($ti=10;$ti<18;$ti++) {
			$record_query="select * from `cctv_data` where `NO` like '$ti'";
			$record_result=mysqli_query($connect,$record_query);
			$record_row=mysqli_fetch_array($record_result);
			if($record_row['$table_name']>0) {
				$onums=$record_row[$table_name];
			}
			else {
				mysqli_query($connect,"SELECT count(`OBJECT_ID`) FROM `$table_name` where `TIME` like '$ti%' group by `OBJECT_ID`");
				$onums=mysqli_affected_rows($connect);
				$update_query="update `cctv_data` set `$table_name`='$onums'  where `NO` like '$ti'";
				mysqli_query($connect,$update_query);
			}
			if($onums>440) {
				$style="background-color:#e00000;";
			}
			else if($onums>400) {
				$style="background-color:#ff910a;";
			}
			else if($onums>360) {
				$style="background-color:#cdd100;";
			}
			else if($onums>320) {
				$style="background-color:#83d13f;";
			}
			else if($onums>280) {
				$style="background-color:#0f9429;";
			}
			else if($onums>240) {
				$style="background-color:#00baba;";
			}
			else if($onums>200) {
				$style="background-color:#3d74ff;";
			}
			else {
				$style="background-color:#afa5d6;";
			}
			$time_group.="
				<div class='rect' style='$style'>
					<p>[$ti]</p>
					<p>($onums)</p>
				</div>
			";
			if($ti==17) $time_group.="<br />";
		}
		if($table_name!="cctv_data") {
			/*
			$tables.="
				<div class='rect'>
					<d>$cctv</d>
				</div>
				$time_group
			";
			*/
		}
		else {
			//
		}
		$time_group="";
	}
	
	$map_links="
		<!--<div class='rect'><d>&nbsp;</d></div>-->
	";
	for($mi=10;$mi<18;$mi++) {
		$map_links.="
			<div class='rect'><d><a href='?tg=$mi'>[$mi]</a></d></div>
		";
	}
	echo "
		$map_links<br />
		$tables<br />
		<!--<img src='cctv_position.png' />-->
	";
	
	$tg=$_GET['tg'];
	if($tg!="") {
		$tg1=$tg+1;
		$tables="";
		$tables_query="SHOW TABLES;";
		$tables_result=mysqli_query($connect,$tables_query);
		$tables_num=mysqli_affected_rows($connect);
		for($i=0;$i<$tables_num;$i++) {
			$table_row=mysqli_fetch_array($tables_result);
			$table_name=$table_row[0];
			
			$num_query="select * from `cctv_data` where `NO` like '$tg'";
			$num_result=mysqli_query($connect,$num_query);
			$num_row=mysqli_fetch_array($num_result);
			$pnums=$num_row[$table_name];
			if($pnums>440) {
				$style="background-image:linear-gradient(to right, white, #e00000, white);";
			}
			else if($pnums>400) {
				$style="background-image:linear-gradient(to right, white, #ff910a, white); background-color:#ff910a;";
			}
			else if($pnums>360) {
				$style="background-image:linear-gradient(to right, white, #cdd100, white); background-color:#cdd100;";
			}
			else if($pnums>320) {
				$style="background-image:linear-gradient(to right, white, #83d13f, white); background-color:#83d13f;";
			}
			else if($pnums>280) {
				$style="background-image:linear-gradient(to right, white, #0f9429, white); background-color:#0f9429;";
			}
			else if($pnums>240) {
				$style="background-image:linear-gradient(to right, white, #00baba, white); background-color:#00baba;";
			}
			else if($pnums>200) {
				$style="background-image:linear-gradient(to right, white, #3d74ff, white); background-color:#3d74ff;";
			}
			else {
				$style="background-image:linear-gradient(to right, white, #afa5d6, white); background-color:#afa5d6;";
			}
			if($table_name!="cctv_data") {
				$tables.="
					<div class='road' id='$table_name' style='$style'>$table_name</div>
				";
			}
			else {
				//
			}
		}
		echo "
			<div>
				$tg 시~ $tg1 시
			</div>
			<div class='map'>
				$tables
			<?div>
		";
	}
	
?>
		<br />
	</body>
</html>