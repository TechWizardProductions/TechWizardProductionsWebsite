<?php
session_start();
$rootdir = "../";
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017 -->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Register / Log In | TechWizard Productions</title>
</head>
<body>
<?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
?>
    <div id="content">
        <?php
        if (isset($_SESSION['auth']) && isset($_SESSION['timeout'])){
            if($_SESSION['auth'] == true && $_SESSION['timeout'] >= time()){
                $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
                echo "You have been logged in already. There will not be anything useful for you on this page.";
            }
            else {
                include($rootdir . "forms/register.inc.php");
        
                echo '<div id="logIn">';
                echo "Already a member? Log in below!";
                
                include($rootdir . "forms/logIn.inc.php");
                }
        } else {
            include($rootdir . "forms/register.inc.php");
    
            echo '<div id="logIn">';
            echo "Already a member? Log in below!";
            
            include($rootdir . "forms/logIn.inc.php");
            }
        ?>
    </div>
    <?php
            include($rootdir . "style/footer.inc.php");
    ?>
    </div>
</body>
</html>