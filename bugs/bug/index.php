<?php
        session_start();
        $rootdir = "../../";
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
        include($rootdir . "admin/database.inc.php");
        $database = connectDatabase();
        $bug_ID = $_GET['id'];
        $RequestVoted = 'SELECT * FROM votes WHERE bug_ID = ' . $bug_ID . ' AND user_ID = "'. $_SESSION['user_ID'] . '"';
        $ResultVoted = parseQuery($database, $RequestVoted);
        if($ResultVoted != false){
            $voted = true;
            if($ResultVoted['vote'] == "yes"){
                $votedYes = true;
            } else {
                $votedNo = true;
            }
        } else {
            $voted = false;
        }

    if($_POST && $voted == false){
            if($_POST['yes']){
                $UpdateVotes = 'INSERT INTO votes (bug_ID, user_ID, vote) VALUES (' . $bug_ID . ',' . $_SESSION['user_ID'] . ', "yes"';
                parseQueryOnly($database, $UpdateVotes);
                $voted = true;
            }

            if($_POST['no']){
                $UpdateVotes = 'INSERT INTO votes (bug_ID, user_ID, vote) VALUES (' . $bug_ID . ',' . $_SESSION['user_ID'] . ', "no"';
                parseQueryOnly($database, $UpdateVotes);
                $voted = true;
            }
    }
        $RequestReport = 'SELECT * FROM bugs WHERE bug_ID = ' . $bug_ID;
        $bug = parseQuery($database, $RequestReport);
        $RequestVoteYesCount = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $bug_ID . ' AND vote = "yes"';
        $RequestVoteNoCount = 'SELECT COUNT(vote) FROM votes WHERE bug_ID = ' . $bug_ID . ' AND vote = "no"';
        $yesVotes = parseQuery($database, $RequestVoteYesCount);
        $noVotes = parseQuery($database, $RequestVoteNoCount);
        $votes = $yesVotes[0] - $noVotes[0];
        $bug['votes'] = $votes;

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
    <br /> <br/>
    <h1>
        Bug Report
    </h1>
    <h2>
        <?php echo $bug['name']; ?>
    </h2>
    <table class="bug">
        <tr>
            <th>
                User:
            </th>
            <th>
                Date:
            </th>
            <th>
                Status:
            </th>
            <th>
                Description:
            </th>
            <th>
                Confirmations:
            </th>
            <th>
                Confirm?
            </th>
        </tr>
        <tr>
            <td>
                <?php echo $bug['user']; ?>
            </td>
            <td>
                <?php echo $bug['date']; ?>
            </td>
            <td>
                <?php echo $bug['status']; ?>
            </td>
            <td>
                <?php echo $bug['description']; ?>
            </td>
            <td>
                <?php echo $bug['votes']; ?>
            </td>
            <td>
            <?php
            if($bug['status'] != "Solved"){
                if($voted){
                    if($votedYes){
                        echo '<button id="VoteYes">Yes</button><button>No</button>';
                    } else if($votedNo){
                        echo '<button>Yes</button><button id="VoteNo">No</button>';
                    }
                
                } else {
                    echo '<form id="confirm" action = "' . $rootdir . 'bugs/bug/?id=' . $bug_ID . '" method="post">
                        <input type="submit" name="yes" value="Yes" />
                        <input type="submit" name="no" value="No" />
                        </form>';
                }
            } else {
                echo '<img src="' . $rootdir . 'images/cross.png"/>';
            }
            ?>   
            </td>
        </tr>
</body>
</html>