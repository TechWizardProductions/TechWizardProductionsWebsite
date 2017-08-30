<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 16/02/2017 -->
<head>
    <?php
        $rootdir = "../";
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Account | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
    <br />
        <?php
        if($_SESSION['auth'] == true && $_SESSION['timeout'] >= time()){
           $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
           echo "<h1> Account Information </h1>";
           echo "On this page your account information will be displayed and you can update this information. <br />";
           echo '<a href="edit.php">Edit<img src="' . $rootdir . 'images/edit.png" width="20" heigth="200"></a>';
            include($rootdir . "account/info.php");
            include($rootdir . "account/logOut.inc.php");
        } else {
        echo 'This session has timed out. Please log in again <a href="'. $rootdir .'/register-login">here</a>';
        }
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>