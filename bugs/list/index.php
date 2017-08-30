<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<!-- Last edited on 11/04/2017-->
<head>
    <?php 
        $rootdir = "../../";
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/bug.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Bug Tracker | TechWizard Productions</title>
</head>
<body>
    <img src="<?php echo $rootdir; ?>images/bugbanner.png" alt="TechWizard Productions Bug Tracker" id="logo">
    <?php
    if(session_id() == ''){
        session_start();
    }
    if(isset($_SESSION['timeout']) && isset($_SESSION['auth'])){
        if($_SESSION['timeout'] >= time() && $_SESSION['auth'] == true){
            include($rootdir . "style/bugNav.inc.php");
            $_SESSION['timeout'] += time();
        }
    } else {
        echo '<script type=text/javascript>
        window.alert("You are not logged in and thus do not have access to this page. Please login on the next page");
        window.location.href = "'.$rootdir.'/register-login";
        </script>';
    }
    ?>
    <br /> <br />
    <h1>
        Bug List
    </h1>
    <p>
        This is the list which contains every single bug. It is sorted (by default) by status, with unconfirmed first, confirmed second, verified third and solved last. Within the status sorting, it is 
        also sorted by number of confirmations, with the most confirmations first and least confirmations last. The only exception being solved, which is sorted by date (most recent first).
    </p>
    <?php
        function csort(array $a, array $b){
            if($b['votes'] < $a['votes']){
                return -1;
            } else if($b['votes'] > $a['votes']){
                return 1;
            } else {
                return 0;
            }
        }
        function ssort(array $a, array $b){
            if($b['date'] < $a['date']){
                return -1;
            } else if($b['date'] > $a['date']){
                return 1;
            } else {
                return 0;
            }
        }
        include($rootdir . "admin/database.inc.php");
        connectDatabase();
        //Getting a list of bugs, sorted by category
        $SQLRequestSolvedBugs = 'SELECT bug_ID, name, votes, user, date FROM bugs WHERE status = "solved"';
        $SQLRequestVerifiedBugs = 'SELECT bug_ID, name, votes, user, date FROM bugs WHERE status = "verified"';
        $SQLRequestConfirmedBugs = 'SELECT bug_ID, name, votes, user, date FROM bugs WHERE status = "confirmed"';
        $SQLRequestUnconfirmedBugs = 'SELECT bug_ID, name, votes, user, date FROM bugs WHERE status = "unconfirmed"';

        //Checking if the list is there
        $solvedBugs = parseQueryOnly($SQLRequestSolvedBugs);
        $verifiedBugs = parseQueryOnly($SQLRequestVerifiedBugs);
        $confirmedBugs = parseQueryOnly($SQLRequestConfirmedBugs);
        $unconfirmedBugs = parseQueryOnly($SQLRequestUnconfirmedBugs);

        //Defining arrays
        $solved = array();
        $verified = array();
        $confirmed = array();
        $unconfirmed = array();

        if(gettype($solvedBugs) == 'resource'){
            $sRequest = mysql_query($SQLRequestSolvedBugs);
            $s = 0;
            while($SB = mysql_fetch_assoc($sRequest)){
                $solved[] = $SB;
            }
        }

        if(gettype($verifiedBugs) == 'resource'){
            $vRequest = mysql_query($SQLRequestVerifiedBugs);
            $v = 0;
            while($VB = mysql_fetch_assoc($vRequest)){
                $verified[] = $VB;
            }
        }

        if(gettype($confirmedBugs) == 'resource'){
            $cRequest = mysql_query($SQLRequestConfirmedBugs);
            $c = 0;
            while($CB = mysql_fetch_assoc($cRequest)){
                $confirmed[] = $CB;
            }
        }

        if(gettype($unconfirmedBugs) == 'resource'){
            $uRequest = mysql_query($SQLRequestUnconfirmedBugs);
            $u = 0;
            while($UCB = mysql_fetch_assoc($uRequest)){
                $unconfirmed[] = $UCB;
            }
        }

        if(isset($unconfirmed)){
            $maxUnconfirmed = count($unconfirmed);
            if($maxUnconfirmed != 0){
                usort($unconfirmed, 'csort');
                $maxUnconfirmed--;
                $ue = 0;
                echo "<table class=bugList><th><h3>Unconfirmed</h3></th>";
                echo "<tr><td>Confirmations</td><td>Bug ID</td><td>Date</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($ue <= $maxUnconfirmed){
                    echo "<tr><td>" . $unconfirmed[$ue]['votes'] . "</td><td>" . $unconfirmed[$ue]['bug_ID'] . "</td><td>" . $unconfirmed[$ue]['date'] ."</td><td>" . $unconfirmed[$ue]['user'] . "</td><td>" . $unconfirmed[$ue]['name'] . '</td><td><a href="../bug/?id=' . $unconfirmed[$ue]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $ue++;
                }
                echo "</table>";
            }
        }

        if(isset($confirmed)){
            $maxConfirmed = count($confirmed);
            if($maxConfirmed != 0){
                usort($confirmed, 'csort');
                $maxConfirmed--;
                $ce = 0;
                echo "<table class=bugList><th><h3>Confirmed</h3></th>";
                echo "<tr><td>Confirmations</td><td>Bug ID</td><td>Date</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($ce <= $maxConfirmed){
                    echo "<tr><td>" . $confirmed[$ce]['votes'] . "</td><td>" . $confirmed[$ce]['bug_ID'] . "</td><td>" . $confirmed[$ce]['date'] . "</td><td>" . $confirmed[$ce]['user'] . "</td><td>" . $confirmed[$ce]['name'] . '</td><td><a href="../bug/?id=' . $confirmed[$ce]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $ce++;
                }
                echo "</table>";
            }
        }

        if(isset($verified)){
            $maxVerified = count($verified);
            if($maxVerified != 0){
                usort($verified, 'csort');
                $maxVerified--;
                $ve = 0;
                echo "<table class=bugList><th><h3>Verified</h3></th>";
                echo "<tr><td>Confirmations</td><td>Bug ID</td><td>Date</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($ve <= $maxVerified){
                    echo "<tr><td>" . $verified[$ve]['votes'] . "</td><td>" . $verified[$ve]['bug_ID'] . "</td><td>" . $verified[$ve]['date'] . "</td><td>" . $verified[$ve]['user'] . "</td><td>" . $verified[$ve]['name'] . '</td><td><a href="../bug/?id=' . $verified[$ve]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $ve++;
                }
                echo "</table>";
            }
        }

        if(isset($solved)){
            $maxSolved = count($solved);
            if($maxSolved != 0){
                usort($solved, 'ssort');
                $maxSolved--;
                $se = 0;
                echo "<table class=bugList><th><h3>Solved</h3></th>";
                echo "<tr><td>Date</td><td>Bug ID</td><td>Confirmations</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($se <= $maxSolved){
                    echo "<tr><td>" . $solved[$se]['date'] . "</td><td>" . $solved[$se]['bug_ID'] . "</td><td>" . $solved[$se]['votes'] . "</td><td>" . $solved[$se]['user'] . "</td><td>" . $solved[$se]['name'] . '</td><td><a href="../bug/?id=' . $solved[$se]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $se++;
                }
                echo "</table>";
            }
        }
    ?>
</body>
</html>