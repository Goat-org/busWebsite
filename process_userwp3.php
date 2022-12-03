<?php
$mysqli = require __DIR__ . "/connect.php";
$query = $mysqli->query("SELECT * FROM user");

$query = "SELECT * FROM user";

if ($result = $mysqli->query($query)) {

    
    while ($row = $result->fetch_assoc()) {
        $? = $row["name"];
        $? = $row["surname"];
		$? = $row["email"];
	    $? = $row["contact"];
    }
 
    $result->free();
}