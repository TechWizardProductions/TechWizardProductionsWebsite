<?php
    $rootdir = "../";
    session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2016-->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Contact| TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
        <br />
        <p>
            <h1>
                Contact
            </h1>
        </p>
        <?php
            if ($_SESSION['auth'] == true && $_SESSION['timeout'] >= time()){
            } else {
                echo '<p>
                        If you want more choice of topics, please sign-up for a free account. If you feel like a certain topic should be available for non-members, please contact us by registering 
                        and using the "Suggestion" topic.
                      </p>';
            }
            include($rootdir . 'forms/contact.inc.php');
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>