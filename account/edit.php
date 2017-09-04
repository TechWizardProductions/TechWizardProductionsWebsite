<?php
    $rootdir = "../";
    session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 04/09/2017 -->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir ?>style/style.css">
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
         if($_SESSION['auth'] == true && $_SESSION['timeout'] >= time()){
           $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
           echo '<br> </br>';
            include($rootdir . "forms/editInfo.inc.php");
        } else {
        echo 'This session has timed out. Please log in again <a href="'. $rootdir .'/register-login">here</a>';
        }
            include ($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>
