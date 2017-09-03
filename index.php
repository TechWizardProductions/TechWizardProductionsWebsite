<?php
        $rootdir = "";
        include("admin/database.inc.php");
        $database = connectDatabase();
        $SQLGetPatch = "SELECT number from twppatches ORDER BY patch_ID DESC LIMIT 1";
        $patch = parseQuery($database, $SQLGetPatch);
        session_start();
        $_SESSION['patch'] = $patch['number'];
        echo
        '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
        <!-- Last edited on 16/03/2017-->
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="style/style.css">
            <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
            <title>Home Page | TechWizard Productions</title>
        </head>
        <body>';
                include("style/header.inc.php");
                include($rootdir . "style/navigation.inc.php");
                echo'
            <div id="content">
                <h1>
                    TechWizard Productions
                </h1>
                <p>
                    Welcome to my website! Currently I\'m working on this page and a lot of things will change, so don\'t get too attached to this page as
                    it will change a lot. I am building this website by myself (TechWizard) and I\'m doing this all without any help from interfaces and such.
                    I will program this website using HTML, PHP and MySQL. Currently I am still learning PHP and MySQL so I thought that this would be an
                    excellent opportunity to practice all my skills. So that\'s it and I hope you enjoy browsing my website.
                </p>
                <p>
                    <b>
                        IMPORTANT: 
                    </b>
                    this website is protected against DDoS attacks. This means that every IP Address that sends more than 2000 http requests per 24 hours will be banned for 24 hours. 
                    An http request is everything you do on this website, from refreshing a page, visiting another page till clicking the "register" button. This is intentional 
                    and cannot be disabled. If you are banned I cannot help you as this is a server setting which my host will not allow me to edit.
                </p>
                <p>
                    <b>
                        NOTE: 
                    </b>
                    this website is still under construction, changes can and will be made without prior notice.
                </p>';
                    include("style/footer.inc.php");
                    echo'
            </div>
        </body>
        </html>';
?>