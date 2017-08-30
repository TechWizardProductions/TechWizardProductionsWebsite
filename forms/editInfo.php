<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
        $rootdir = '../';
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Edit Account Details | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
    <br />
        <?php
            include($rootdir . "admin/database.inc.php");
            connectDatabase();
            $username = strip_tags($_POST['username']);
            $firstName = strip_tags($_POST['firstName']);
            $lastName = strip_tags($_POST['lastName']);
            $password = strip_tags($_POST['password']);
            $email = strip_tags($_POST['email']);
            $timeout = $_POST['timeout'];
            $i = 1;

            $update = array();
            $sesUpdate = array();
            $sesName = array();
            $sesName[1] = "username";
            $sesName[2] = "firstName";
            $sesName[3] = "lastName";
            $sesName[4] = "email";
            $sesName[5] = "password";
            $sesName[6] = "timeout";

            $timeoutArray = array();
            $timeoutArray[1] = 900;
            $timeoutArray[2] = 1800;
            $timeoutArray[3] = 3600;
            $timeoutArray[4] = 5400;
            $timeoutArray[5] = 7200;

            if ($username !== $_SESSION['username']){
                $SQLRequestUsr = 'SELECT username FROM Accounts WHERE username =' . $username;
                $UsrData = parseQuery($SQLRequestUsr);
                if($UsrData['username'] !== $username){
                    $update[1] = 'UPDATE Accounts SET username = "'. $username .'" WHERE user_ID = ' . $_SESSION['user_ID'];
                    $sesUpdate[1] = $username;
                } else {
                    $errormsg = "The username you have chosen already exists. <br/>";
                }
            }

            if (!is_null($firstName) && $firstName !== $_SESSION['firstName']){
                $update[2] = 'UPDATE Accounts SET firstName = "' . $firstName . '" WHERE user_ID = ' . $_SESSION['user_ID'];
                $sesUpdate[2] = $firstName;
            }

            if (!is_null($lastName) && $lastName !== $_SESSION['lastName']){
                $update[3] = 'UPDATE Accounts SET lastName = "' . $lastName . '" WHERE user_ID = ' . $_SESSION['user_ID'];
                $sesUpdate[3] = $lastName;
            }

            if ($email !== $_SESSION['email']){
                $SQLRequestEmail = 'SELECT email FROM Accounts WHERE email =' . $email;
                $EmailData = parseQuery($SQLRequestEmail);
                if($EmailData['email'] !== $email){
                    $update[4] = 'UPDATE Accounts SET email = "'. $email .'" WHERE user_ID = ' . $_SESSION['user_ID'];
                    $sesUpdate[4] = $email;
                } else {
                    $errormsg.= "The email adress you have chosen is already used by another account. <br />"; 
                }
            }

            if ($password !== $_SESSION['password']){
                $update[5] = 'UPDATE Accounts SET password = "'. $password .'" WHERE user_ID = ' . $_SESSION['user_ID'];
                $sesUpdate[5] = $password;
            }

            if ($timeout !== $_SESSION['timeoutTime']){

                switch($timeout){
                    case 1 : $update[6] = 'UPDATE Accounts SET timeout = "900" WHERE user_ID = ' .$_SESSION['user_ID']; $sesUpdate[6] = time() + 900; break;
                    case 2 : $update[6] = 'UPDATE Accounts SET timeout = "1800" WHERE user_ID = ' .$_SESSION['user_ID']; $sesUpdate[6] = time() + 1800; break;
                    case 3 : $update[6] = 'UPDATE Accounts SET timeout = "3600" WHERE user_ID = ' .$_SESSION['user_ID']; $sesUpdate[6] = time() + 3600; break;
                    case 4 : $update[6] = 'UPDATE Accounts SET timeout = "5400" WHERE user_ID = ' .$_SESSION['user_ID']; $sesUpdate[6] = time() + 5400; break;
                    case 5 : $update[6] = 'UPDATE Accounts SET timeout = "7200" WHERE user_ID = ' .$_SESSION['user_ID']; $sesUpdate[6] = time() + 7200; break;
                }
            }

            while ($i <= 6){
                if(isset($update[$i])){
                    parseQuery($update[$i]);
                    if(isset($sesUpdate[$i])){
                        $_SESSION[$sesName[$i]] = $sesUpdate[$i];
                    }
                $i++;
                } else {
                    $i++;
                }
            }
            if (isset($errormsg)){
                echo "All changes have been saved except for the ones listed below:";
                echo $errormsg;
                echo "If you want to change the ones listed above, please try again.";
            } else {
                $_SESSION['timeoutTime'] = $timeoutArray[$timeout];
                echo "Changes have been saved";
            }

            mysql_close();

            ?>
        <?php
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>