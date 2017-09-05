<?php
    $rootdir = "../../../";
    session_start();
    include($rootdir . "admin/database.inc.php");
    
            $database = connectDatabase();
    
            $SQLRequestPatch = "SELECT patch_ID FROM twppatches ORDER BY patch_ID DESC LIMIT 1";
            $patchID = parseQuery($database, $SQLRequestPatch);
    
            $max = $patchID['patch_ID'];
            $max++;
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017 -->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Patch Index | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
        ?>
        <div id="content">
        <h1>
            Patch Index
        </h1>
        <p>
            This page contains the complete list of patches that the TechWizard Productions Website has used. A complete changelog, ordered from the most recent patch to the oldest patch in existence. 
            Click on each link to view the Patch Note's content. The bottom most Patch is the "Legacy Patch", or all the patches from before this system was introduced. View Patch 1.1.1 for more details.
        </p>
         <?php
            //List with all the patch notes
            for ($i = 1; $i < $max; $i++){
                $j = $max - $i;
                $SQLRequestPatchNumber = "SELECT number from twppatches WHERE patch_ID = $j";
                $patchNumber = parseQuery($SQLRequestPatchNumber);
                echo '<a href="'. $rootdir . 'projects/TWPWeb/patchlist/patch.php?patch=' . $j . '">Patch '. $patchNumber['number'] .'</a><br/>';
            }
            echo '<a href="'. $rootdir . 'projects/TWPWeb/patchlist/patch.php?patch=Legacy">Legacy Patch</a>';
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>