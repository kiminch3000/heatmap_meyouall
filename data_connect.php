<?php
	$dbname="Your MYSQL Database Name";
	$dbuser="Your MYSQL Database User Name";
	$dbpassword="Your MYSQL Password";
	$connect=mysqli_connect("localhost",$dbuser,$dbpassword,$dbname);
	if(mysqli_connect_errno()) { echo "Failed to connect to database: " . mysqli_connect_error(); }
	mysqli_query($connect,"set names utf8");
