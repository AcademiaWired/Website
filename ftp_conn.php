<?php
	$conn = new mysqli('sql5c75d.carrierzone.com','academiawi496383','plmnko90','db_academiawi496383');
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->query("SET NAMES 'utf8'");
	$conn->query('SET character_set_connection=utf8');
	$conn->query('SET character_set_client=utf8');
	$conn->query('SET character_set_results=utf8');
?>