<?php
    $rootdir = "../";
    session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017 -->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Projects | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
        <h1>
            Projects
        </h1>
    <p>
        This is the home page for all of my projects. Click on the title of the project to get to know more about the project. Only the active (if not enough active, 
        the three most recent) projects are part of the Navigation Bar. Completed projects will be shown here with the prefix <i>Completed</i>Each project page will 
        contain the following:
    </p>
        <ul>
            <li>
                Project Name
            </li>
            <li>
                Description of the project
            </li>
            <li>
                Most recent update
            </li>
            <li>
                Less recent update
            </li>
            <li>
                Historical updates
            </li>
        </ul>
    <p>
        If one of the pages doesn't tick all the boxes of the above list, please use the contact page to send your findigs through.
    </p>
        <ul>
            <li>
                <a href="<?php echo $rootdir ?>projects/TWPWeb/">
                    TechWizard Productions Website
                </a>
            </li>
            <li>
                <a href="<?php echo $rootdir ?>projects/NL2TFFBN/">
                    No Limits 2 - The Fight for Baron Nashor
                </a>
            </li>
        </ul>
     <?php
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>