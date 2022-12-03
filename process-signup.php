<?php 

	
if (empty($_POST["name"])) {
    die("Name is required");
}

if (empty($_POST["surname"])) {
    die("Surname is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["contact"])) {
    die("Contact is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

	
$mysqli = require __DIR__ . "/connect.php";

$sql = "INSERT INTO user (name, surname, email, contact, password_hash)
        VALUES (?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $_POST["name"],
                  $_POST["surname"],
				  $_POST["email"],
				  $_POST["contact"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: login.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}


	
?>