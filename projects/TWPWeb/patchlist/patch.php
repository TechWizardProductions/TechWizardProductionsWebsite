<?php
$rootdir = "../../../";
include($rootdir . "admin/database.inc.php");

        $database = connectDatabase();
        $patchNumber = strip_tags($_GET['patch']);
        $SQLGetPatch = "SELECT * FROM twppatches WHERE patch_ID = $patchNumber";

        if ($patchNumber == "Legacy"){
            $legacy = true;
        } else {
            $patch = parseQuery($database, $SQLGetPatch);
        }
        ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 05/09/2017 -->
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Patch Notes | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");
    ?>
    <div id="content">
        <?php
        if($legacy == true){
            include($rootdir . 'projects/TWPWeb/patchlist/legacy.inc.php');
        } else if(is_null($patch['patch_ID'])){
            echo "The Patch ID is invalid. Please go back to the page you came from and retry. If this problem persists, please contact us via the contact page.";
        } else {
            echo "<h1>
                    Patch: " . $patch['number'] . "
                  </h1>";
            echo '<p>
                    <i> ' . $patch['date'] . '</i><div class="PN">' . $patch['number'] . '</div><br/>
                    ' . $patch['description'] . '<div class="signOut"> - TechWizard </div>
                  </p>
                  ';
            if(!is_null($patch['new'])){
                echo '<h2>
                        New:
                      </h2>
                      <ul>
                        ' . $patch['new'] . '
                      </ul>';
            }
            if(!is_null($patch['changes'])){
                echo '<h2>
                        Changes:
                      </h2>
                      <ul>
                        ' . $patch['changes'] . '
                      </ul>';
            }
            if(!is_null($patch['bugs'])){
                echo '<h2>
                        Bug Fixes:
                      </h2>
                      <ul>
                        ' . $patch['bugs'] . '
                      </ul>';
            }
        }
           include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>