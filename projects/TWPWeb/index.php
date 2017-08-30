<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 06/04/2017 -->
<head>
    <?php
        $rootdir = "../../";
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Patch Notes | TechWizard Productions</title>
</head>
<body>
    <?php
        include("../../style/header.inc.php");

        include("../../style/navigation.inc.php");

        include($rootdir . "admin/database.inc.php");

        connectDatabase();

        $SQLRequestPatch = "SELECT patch_ID FROM twppatches ORDER BY patch_ID DESC LIMIT 1";
        $patchID = parseQuery($SQLRequestPatch);

        $max = $patchID['patch_ID'];
        $max++;

        $j = 1;

        for($i = 1; $i < $max; $i++){
            $patch = $max - $i;

            $SQLRequestPatchNote = "SELECT * FROM twppatches WHERE patch_ID = " . $patch . "";
            ${'data' . $i} = parseQuery($SQLRequestPatchNote);
        }

        $patches = 0;

        for($k = 1; $k <= 5; $k++){
            if (isset (${'data' . $k})){
                $patches ++;
            }
        }
    ?>
    <div id="content">
        <br />
        <p>
            <h1>
                TechWizard Productions Website
            </h1>
        </p>
        <p>
            The TechWizard Productions Website is an ongoing project where TWP is working hard to build 
            the very website you are viewing right now! This page, and the website as it is will be updated 
            weekly. New pages will be added, layouts will change and bugs will be smashed. Every major update 
            can be found on this page, featuring a full list of changes (also called the "Patch Notes") each week. Not every patch will be shown here,
            only the five most recent ones. But fear not, those other Patch Notes can still be found. Just underneath this description there is a button to the page which contains the full list of all
            the Patch Notes ever created. Also known as "The Patch Index".
        </p>
        <form action="<?php echo $rootdir; ?>projects/TWPWeb/patchlist">
            <input type="submit" value="The Patch Index" id="patchIndex">
        </form>
        <h2>
            Patch Notes:
        </h2>
        <?php
        while ($j <= $patches) {
            if ($j == $patches){
                echo '<div class="Patch" id="bottomPatch">';
            } else {
                echo '<div class="Patch">';
            }
            echo    '<p>
                        <i>' . ${'data' . $j}['date'] .'</i><div class="PN">'. ${'data' . $j}['number'].'</div></br>
                        '. ${'data' . $j}['description'] .'<div class="signOut"> - TechWizard</div>
                    </p>
                    ';
            if(!is_null(${'data' . $j}['new'])){
                echo '<h2>
                        New:
                      </h2>
                      <ul>
                        '. ${'data' . $j}['new'] .'
                      </ul>';
            } if (!is_null(${'data' . $j}['changes'])){
                echo '<h2>
                        Changes:
                      </h2>
                      <ul>
                        '. ${'data' . $j}['changes'] .'
                      </ul>';
            } if (!is_null(${'data' . $j}['bugs'])){
                echo '<h2>
                        Bug Fixes:
                      </h2>
                      <ul>
                        '. ${'data' . $j}['bugs'] .'
                      </ul>';
            }
            echo '</div>';
            $j++;
        } 
        ?>
        <?php
            include("../../style/footer.inc.php");
        ?>
    </div>
</body>
</html>