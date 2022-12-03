<?php 

	
if (empty($_POST["Name"])) {
    die("Name is required");
}

if (empty($_POST["Surname"])) {
    die("Surname is required");
}

if ( ! filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["Contact"])) {
    die("Contact is required");
}


	
$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO customer (Name, Surname, Email, Contact)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["Name"],
                  $_POST["Surname"],
				  $_POST["Email"],
				  $_POST["Contact"]
                  );
                  
if ($stmt->execute()) {

    header("Location: BuswebsiteHome.html");
    exit;
    
} 


	
?>