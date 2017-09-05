<?php
    $rootdir = "../";
    session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017-->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/bug.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Bug Tracker | TechWizard Productions</title>
</head>
<body>
    <img src="<?php echo $rootdir; ?>images/bugbanner.png" alt="TechWizard Productions Bug Tracker" id="logo">
    <?php
    if(isset($_SESSION['timeout']) && isset($_SESSION['auth'])){
        if($_SESSION['timeout'] >= time() && $_SESSION['auth'] == true){
            include($rootdir . "style/bugNav.inc.php");
        }
    }
    ?>
    <br />
    <br />
    <h1>
        TechWizard Productions Bug Tracker
    </h1>
    <p>
        Welcome to the TechWizard Productions Bug Tracker. Here you can report bugs, view the current bugs and see the list of previous smashed bugs. Members are able to report bugs, if you are no
        member yet and you want to report a bug as well, you can sign up for an account <a href= "<?php echo $rootdir; ?>register-login">here</a>. Each member will have a so called bug score. This is 
        an indicator how trustworthy a bug reporter is. Everyone starts with 50 points, if you sucesfully identify and report bugs your score will increase. If you create a false bug report your score 
        will go down. So if you want to report a bug, check first if it isn't already reported. If you however still report the bug, whilst it already is reported, your report will get marekd as duplicate 
        which will reduce your score. If you find a bug that is already reported, please take the time to help confirm the bug. The more people confirm the bug, the sooner it is solved. Namely the most 
        confirmed bugs will end up as the highest priority, except if another bug is reported that is site-breaking, meaning very few, if not all pages refuse to function properly.
</body>
</html>