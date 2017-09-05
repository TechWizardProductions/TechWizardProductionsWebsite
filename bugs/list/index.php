<?php
    $rootdir = "../../";
        session_start();
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
        exit;
    }
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
    $database = connectDatabase();
    //Getting a list of bugs, sorted by category
    $SQLRequestfixedBugs = 'SELECT bug_ID, name, user, date FROM bugs WHERE status = "fixed"';
    $SQLRequestinProgressBugs = 'SELECT bug_ID, name, user, date FROM bugs WHERE status = "In Progress"';
    $SQLRequestConfirmedBugs = 'SELECT bug_ID, name, user, date FROM bugs WHERE status = "confirmed"';
    $SQLRequestUnconfirmedBugs = 'SELECT bug_ID, name, user, date FROM bugs WHERE status = "unconfirmed"';

    //Checking if the list is there
    $fixedBugs = parseQueryOnly($database, $SQLRequestfixedBugs);
    $inProgressBugs = parseQueryOnly($database, $SQLRequestinProgressBugs);
    $confirmedBugs = parseQueryOnly($database, $SQLRequestConfirmedBugs);
    $unconfirmedBugs = parseQueryOnly($database, $SQLRequestUnconfirmedBugs);

    //Defining arrays
    $fixed = array();
    $inProgress = array();
    $confirmed = array();
    $unconfirmed = array();

    if(gettype($fixedBugs) == 'object'){
        $sRequest = mysqli_query($database, $SQLRequestfixedBugs);
        while($SB = mysqli_fetch_assoc($sRequest)){
            $fixed[] = $SB;
        }

        $countFixed = count($fixed);
        if($countFixed != 0){
            $countFixed--;
            $f = -1;
            while($countFixed != $f){
                $f++;
                $SQLRequestYesVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $fixed[$f]['bug_ID'] . ' AND vote = "yes"';
                $SQLRequestNoVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $fixed[$f]['bug_ID'] . ' AND vote = "no"';
                $yesVotes = parseQuery($database, $SQLRequestYesVotes);
                $noVotes = parseQuery($database, $SQLRequestNoVotes);
                $votes = $yesVotes[0] - $noVotes[0];
                $fixed[$f]['votes'] = $votes;
            }
        }
    }

    if(gettype($inProgressBugs) == 'object'){
        $pRequest = mysqli_query($database, $SQLRequestinProgressBugs);
        while($PB = mysqli_fetch_assoc($pRequest)){
            $inProgress[] = $PB;
        }

        $countInProgress = count($inProgress);
        if($countInProgress != 0){
            $countInProgress--;
            $p = -1;
            while($countInProgress != $p){
                $p++;
                $SQLRequestYesVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $inProgress[$p]['bug_ID'] . ' AND vote = "yes"';
                $SQLRequestNoVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $inProgress[$p]['bug_ID'] . ' AND vote = "no"';
                $yesVotes = parseQuery($database, $SQLRequestYesVotes);
                $noVotes = parseQuery($database, $SQLRequestNoVotes);
                $votes = $yesVotes[0] - $noVotes[0];
                $inProgress[$p]['votes'] = $votes;
            }
        }
    }

    if(gettype($confirmedBugs) == 'object'){
        $cRequest = mysqli_query($database, $SQLRequestConfirmedBugs);
        while($CB = mysqli_fetch_assoc($cRequest)){
            $confirmed[] = $CB;
        }

        $countConfirmed = count($confirmed);
        if($countConfirmed != 0){
            $countConfirmed--;
            $c = -1;
            while($countConfirmed != $c){
                $c++;
                $SQLRequestYesVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $confirmed[$c]['bug_ID'] . ' AND vote = "yes"';
                $SQLRequestNoVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $confirmed[$c]['bug_ID'] . ' AND vote = "no"';
                $yesVotes = parseQuery($database, $SQLRequestYesVotes);
                $noVotes = parseQuery($database, $SQLRequestNoVotes);
                $votes = $yesVotes[0] - $noVotes[0];
                $confirmed[$c]['votes'] = $votes;
            }
        }
    }

    if(gettype($unconfirmedBugs) == 'object'){
        $uRequest = mysqli_query($database, $SQLRequestUnconfirmedBugs);
        while($UCB = mysqli_fetch_assoc($uRequest)){
            $unconfirmed[] = $UCB;
        }

        $countUnconfirmed = count($unconfirmed);
        if($countUnconfirmed != 0){
            $countUnconfirmed--;
            $u = -1;
            while($countUnconfirmed != $u){
                $u++;
                $SQLRequestYesVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $unconfirmed[$u]['bug_ID'] . ' AND vote = "yes"';
                $SQLRequestNoVotes = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $unconfirmed[$u]['bug_ID'] . ' AND vote = "no"';
                $yesVotes = parseQuery($database, $SQLRequestYesVotes);
                $noVotes = parseQuery($database, $SQLRequestNoVotes);
                $votes = $yesVotes[0] - $noVotes[0];
                $unconfirmed[$f]['votes'] = $votes;
            }
        }
    }
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
    <br /> <br />
    <h1>
        Bug List
    </h1>
    <p>
        This is the list which contains every single bug. It is sorted (by default) by status, with unconfirmed first, confirmed second, in progress third and fixed last. Within the status sorting, it is 
        also sorted by number of confirmations, with the most confirmations first and least confirmations last. The only exception being fixed, which is sorted by date (most recent first).
    </p>
    <?php
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

        if(isset($inProgress)){
            $maxinProgress = count($inProgress);
            if($maxinProgress != 0){
                usort($inProgress, 'csort');
                $maxinProgress--;
                $ve = 0;
                echo "<table class=bugList><th><h3>In Progress</h3></th>";
                echo "<tr><td>Confirmations</td><td>Bug ID</td><td>Date</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($ve <= $maxinProgress){
                    echo "<tr><td>" . $inProgress[$ve]['votes'] . "</td><td>" . $inProgress[$ve]['bug_ID'] . "</td><td>" . $inProgress[$ve]['date'] . "</td><td>" . $inProgress[$ve]['user'] . "</td><td>" . $inProgress[$ve]['name'] . '</td><td><a href="../bug/?id=' . $inProgress[$ve]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $ve++;
                }
                echo "</table>";
            }
        }

        if(isset($fixed)){
            $maxfixed = count($fixed);
            if($maxfixed != 0){
                usort($fixed, 'ssort');
                $maxfixed--;
                $se = 0;
                echo "<table class=bugList><th><h3>Fixed</h3></th>";
                echo "<tr><td>Date</td><td>Bug ID</td><td>Confirmations</td><td>User</td><td>Topic</td><td>Link</td></tr>";
                while($se <= $maxfixed){
                    echo "<tr><td>" . $fixed[$se]['date'] . "</td><td>" . $fixed[$se]['bug_ID'] . "</td><td>" . $fixed[$se]['votes'] . "</td><td>" . $fixed[$se]['user'] . "</td><td>" . $fixed[$se]['name'] . '</td><td><a href="../bug/?id=' . $fixed[$se]['bug_ID'] . '"><button>Read More</button></a></td></tr>';
                    $se++;
                }
                echo "</table>";
            }
        }
    ?>
</body>
</html>