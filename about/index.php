<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 02/02/2017 -->
<head>
    <?php
        $rootdir = "../";
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>About | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
        <p>
            <h1>
                About
            </h1>
        </p>
        <p>
            Welcome to the TechWizard Productions website! This website has been carefully programmed by TechWizard, in order to train his ability to program (although HTML isn't 
            really seen as a programming language, it does lay a pretty good foundation). This website currently doesn't feature much, but soon there will be things to do here. 
            There are plans for a forum, video section, music section, contact section and some more sections. All of this will be done using HTML, CSS, PHP and MySQL. 
            If you have any comments, recommendations, etc. feel free to contact me via the contact section. Bugs can be reported in the Bug Tracker, but an account is required.
            <br />
            Signing off,
            <br />
            -TechWizard
        </p>
        <?php
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>