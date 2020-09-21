<?php
	$host='localhost';
	$port=3306;
	$dbname='db';
	$user='root';
	$pwd='';

	$db=new PDO("mysql:host=$host;port=$port;dbname=$dbname",$user,$pwd);
?>