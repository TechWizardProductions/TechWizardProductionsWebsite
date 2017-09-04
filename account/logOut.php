<?php
    $rootdir = "../";
    session_unset();
    $_SESSION['auth']=false;
    $_SESSION['patch']="1.0.3";
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 16/02/2017 -->
<head>
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
            echo '<script type="text/javascript"> 
            window.alert("You have been succesfully logged out.");
            window.location.href="'. $rootdir . '";
            </script>';
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>
