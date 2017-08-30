<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 08/06/2017-->
<head>
    <?php 
        $rootdir = "../../";
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/bug.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Bug Tracker | TechWizard Productions</title>
</head>
<body>
    <img src="<?php echo $rootdir; ?>images/bugbanner.png" alt="TechWizard Productions Bug Tracker" id="logo">
    <?php
    if(session_id() == ''){
        session_start();
    }
    if(isset($_SESSION['timeout']) && isset($_SESSION['auth'])){
        if($_SESSION['timeout'] >= time() && $_SESSION['auth'] == true){
            include($rootdir . "style/bugNav.inc.php");
            $_SESSION['timeout'] += time();
        }
    } else {
        echo '<script type=text/javascript>
        window.alert("You are not logged in and thus do not have access to this page. Please login on the next page");
        window.location.href = "'.$rootdir.'/register-login";
        </script>';
    }
        include($rootdir . "admin/database.inc.php");
        connectDatabase();

        if($_POST['report']){
            $usr = $_SESSION['username'];
            $name = $_POST['name']; 
            $desc = $_POST['description'];
            $date = date("Y-m-j");
            $votes = 0;
            $status = "Unconfirmed";

            $InsertBugReport = 'INSERT INTO bugs (name, votes, status, date, user, description)
                                VALUES ("' . $name . '", "' . $votes . '", "' . $status . '", "' . $date . '", "' . $usr . '", "' . $desc . '")';
            if(!parseQueryOnly($InsertBugReport)){
                echo "Reporting bug failed! Please try again.";
            } else {
                $email = "techwizardproductions@gmail.com";
                $sender = "auto-reply@techwizardproductions.net16.net";
                $subject = "Bug Report: " . $name . " from: " . $usr;
                $header = 'From: ' . $sender . "\r\n";
                $header .= "MIME-Version: 1.0" . "\r\n";
                $header .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mailBody = "Dear TechWizard,<br></br>";
                $mailBody.= "A bug has been reported by " . $usr . ".<br />";
                $mailBody.= "The title of the report is: " . $name . ". <br />";
                $mailBody.= "The bug description: <br />" . $desc . "<br /> <br/>";
                $mailBody.= "With kind regards, <br />";
                $mailBody.= 'TechWizard Productions Bug Tracker';

                mail($email, $subject, $mailBody, $header);
            }
        }
    ?>
    <br /> <br />
    <h1>
        Report a bug
    </h1>
    <p>
        On this page you are able to report a bug for one of the TechWizard Products. Currently, the only project that you are able to report a bug for is the 
        TechWizard Productions website. Fill in the form completely, and in the description field be as specific as possible about when and how the bug occured. 
        For instance the navigation bar isn't showing up when you log in, please do not just fill in "navigation bar doesn't show up". But instead mention that 
        it happened after you logged in and that it was working before that. Thank you for the time taken to report the bug, and I'll look into it as soon as possible.
    </p>
    <form id="reportBug" method="post" action="<?php echo $rootdir; ?>bugs/report/index.php">
        <table>
            <tr>
                <td>
                    Username:
                </td>
                <td>
                    <input type = "text" value = "<?php echo $_SESSION['username']; ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td>
                    Topic:
                </td>
                <td>
                    <input type = "text" placeholder = "Enter a short but clear description of the bug" name = "name" />
                </td>
            </tr>
            <tr>
                <td>
                    Description:
                </td>
                <td>
                    <input type = "text" placeholder = "Enter the complete description here. Be as specific as possible." name = "description" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Submit Report" name="report" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>