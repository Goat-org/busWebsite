<?php 

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connect.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_userID"] = $user["userID"];
            
            header("Location: userView.php");
            exit;
        }
    }
    
    $is_invalid = true;
}
?>

<!DOCTYPE>
<html>
<head>
<title>
Northern Cape Bus.co
</title>
</head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<style>
header{
background-color: #666;
padding: 30px;
text-align:center;
font-size: 35px;
color: white;}



</style>

<body>

<header>Northern Cape Bus.co</header>
<br>
<center><font size="20">Login</font></font></center>
<form  method="post">
    <label for="email">email</label>
        <input type="email" name="email" id="email"
          value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
<br>
<button>Log in</button>
<br>
Don't Have An Account? <a href="sign_up.html">Sign Up!</a></div>
</form>
            
</center>
</body>

</html>



