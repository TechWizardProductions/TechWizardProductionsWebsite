<?php
$rootdir = "../";
include($rootdir . "admin/database.inc.php");
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
$usrStat = false;
$pwrdStat = false;

$database = connectDatabase();
//Logging code
//Define Timezone
date_default_timezone_set("Europe/Amsterdam");
//Open log file
$logFile = fopen($rootdir . "admin/log.txt", "a");
//Insert log information
fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Log-in attempt started \n"); 
fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Stripping tags completed \n");

if (strlen($username) == 0){
    $errormsg = "You have not specified a username.";
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected no username \n");
}

if (strlen($password) == 0){
    $errormsg.= "You have not entered a password";
    
    //Logging code
    
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected no password \n");
}

//Logging code
fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Required fields check completed \n");



$SQLRequestLogIn = "SELECT * FROM Accounts WHERE username = '" . $username ."'";

$result = parseQuery($database, $SQLRequestLogIn);

if ($result['username'] != $username){
    $errormsg.= "The username you have entered is invalid. Please check your username again";
    $usrStat = false;
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Username has not been found in the database \n");
} else {
    $usrStat = true;
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CHECK]: Username has been found in the database \n");
}

if ($result['password'] != $password){
    $errormsg.= "The password you have entered did not match the password we have. Please check your password again";
    $pwrdStat = false;
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Password did not match the one in the databse \n");
} else {
    $pwrdStat = true;
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CHECK]: Password matched the one in the database \n");
}

//Logging code
fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Log In check completed \n");

if ($usrStat ==true && $pwrdStat == true){
    //Starting session, and configuring internal variables and user variables
    session_start();
    $_SESSION['auth'] = true;
    $_SESSION['timeout'] = time() + $result['timeout'];
    $_SESSION['timeoutTime'] = $result['timeout'];
    $_SESSION['user_ID'] = $result['user_ID'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['firstName'] = $result['firstName'];
    $_SESSION['lastName'] = $result['lastName'];
    $_SESSION['password'] = $result['password'];
    $_SESSION['rank'] = $result['rank'];
    
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: " . $username . " has succesfully logged in \n");
    
    $welcomemsg = "Welcome " . $username . "!";
    $welcomemsg.= "You have succesfully logged in on the website.";
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017 -->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
<link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
<title>Account | TechWizard Productions</title>
</head>
<body>
<?php
include($rootdir . "style/header.inc.php");

include($rootdir . "style/navigation.inc.php");
?>
<div id="content">
<?php
if (isset($errormsg)){
    echo $errormsg;
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Error message has been set \n");
} else {
    echo '<script type=text/javascript>
    window.alert("'.$welcomemsg.'");
    window.location.href = "'.$rootdir.'";
    </script>';
    
    //Logging code
    fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Welcome message has been set \n");
    
}

mysqli_close($database);

//Logging code
fwrite($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Message has been displayed \n\n");
fclose($logFile);
include($rootdir . "style/footer.inc.php");
?>
</div>
</body>
</html>