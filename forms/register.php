<?php
$rootdir = "../";
session_start();
include($rootdir . "admin/database.inc.php");
$username = strip_tags($_POST['username']);
$firstName = strip_tags($_POST['firstName']);
$lastName = strip_tags($_POST['lastName']);
$password = strip_tags($_POST['password']);
$passwordA = strip_tags($_POST['passwordA']);
$email = strip_tags($_POST['email']);

$database = connectDatabase();
//Logging code
//Define Timezone
date_default_timezone_set("Europe/Amsterdam");
//Open log file
$logFile = fopen($rootdir . "admin/log.txt", "a");
//Insert log information
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Account registration has been initiated \n"); 
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Variable check completed \n");

//Check if all the required fields are filled in and set an error message accordingly if it isn't filled in
if (strlen($username) == 0){
    $errormsg = 'You have not entered a username.';

    //Log code
     fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected an empty username \n");
}
if (strlen($password) == 0){
    $errormsg.= 'You have not entered a password.';

    //Log code
     fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected an empty password \n");

}
if (strlen($passwordA) == 0){
    $errormsg.= 'You have not confirmed your password.';

    //Log code
     fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected an empty confirmation password \n");

}
if (strlen($email) == 0){
    $errormsg.= 'You have not entered an e-mail address.';

     //Log code
     fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Detected an empty email address \n");

}

//Log code
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Required fields check completed \n");


//Check if both passwords entered are identical
if ($password !== $passwordA){
    $errormsg.= 'Your passwords do not match.';

    //Log code
     fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Passwords entered do not match \n");

}

//Log code
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Password check completed \n");

$SQLRequestUsr = "SELECT username FROM Accounts WHERE username = '". $username ."'";
$data = parseQuery($database, $SQLRequestUsr);
//Username Check
if ($data ['username'] == $username){
    $errormsg.= 'The username you have chosen already exists. Please choose another.';

    //Log code
    fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Username already exists \n");

}

//Log code
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Username check completed \n");

//Email Check
$SQLRequestEmail = "SELECT email FROM Accounts WHERE email = '". $email ."'";
$data2 = parseQuery($database, $SQLRequestEmail);

if ($data2['email'] == $email){
    $errormsg.= 'The email address you have used is already registered. If you believe this is an error please contact us via the contact page.';

    //Log Code
    fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Email address has already been used \n");
}

//Log Code
fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Email address check completed \n");
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
            //Set the error message if one or more of the required fields hasn't been filled in
            if (isset($errormsg)){
                $msg = 'Registering your account has failed due to <br />';
                $msg.= $errormsg . '<br />';
                $msg.= 'Please <a href=javascript:history.back(1)>return</a> and fill in every required field of the form correctly';

                //Log code
                fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Error message set \n");


            } else {
                //Send records to the database
                $SQLRegisterUsr = "INSERT INTO Accounts (username, password, firstName, lastName, email) VALUES ('". $username . "', '" . $password . "', '" . $firstName . "', '" . $lastName . "', '" . $email . "')";
                $registered = parseQuery($database, $SQLRegisterUsr);

                if(!is_null($registered)){
                    $msg = "Your account registration has been succesful. We have sent you an e-mail with your account details.";

                    echo '<script type="text/javascript">
                    window.alert("'.$msg.'");
                    window.location.href = "'.$rootdir.'";
                    </script>';

                    //Send a confirmation email
                    $sender = "auto-reply@techwizardproductions.net16.net";
                    $subject = 'Confirmation of registrating your account';
                    $header = 'From: ' . $sender . "\r\n";
                    $header .= "MIME-Version: 1.0" . "\r\n";
                    $header .= "Content-Type: text/html; charset=UTF-8\r\n";
                    $mailBody = "Dear " . $username . ".<br></br>";
                    $mailBody.= "Thank you for registering at TechWizard Productions. Hereby we confirm that your registration has been processed by our sytems.<br />";
                    $mailBody.= "Your account details are as followed below: <br></br>";
                    $mailBody.= "Username: " . $username . "<br />";
                    $mailBody.= "Password: " . $password . "<br><br/>";
                    $mailBody.= "Please do not reply to this E-mail. This is an automatically generated message.<br></br>";
                    $mailBody.= "With kind regards, <br />";
                    $mailBody.= 'TechWizard Productions';

                    mail($email, $subject, $mailBody, $header);

                    //Log code
                    fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Account registration has been successful. E-mail has been sent \n");


                } else {
                    $msg = "There has been an error while registering your account. It has NOT been registered. Please try again later.";

                    echo $msg;

                    //Log code
                    fputs($logFile, date("d.m.Y, H:i:s", time()) . "[ERROR]: Account registration was not successful \n");

                }
            }

                mysqli_close($database);


                //Log code
                fputs($logFile, date("d.m.Y, H:i:s", time()) . "[CONSOLE]: Finished registration cycle for " . $username . "\n \n");
                fclose($logFile);
                ($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>