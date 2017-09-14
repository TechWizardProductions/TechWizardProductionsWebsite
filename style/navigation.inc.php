<?php
if(isset($_SESSION['timeout'])){
    $timeout = $_SESSION['timeout'];
}

if(isset($_SESSION['auth'])){
    $auth = $_SESSION['auth'];
}

if(isset($_SESSION['rank'])){
    $rank = $_SESSION['rank'];
}

if(isset($timeout) && isset($auth)){
    if($auth == true && $timeout >= time() && $rank == "admin"){
        include($rootdir . "style/navigationAdmin.inc.php");
        $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
    }else if ($auth == true && $timeout >= time()){
        include($rootdir . "style/navigationLogged.inc.php");
        $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
    } else {
        include($rootdir . "style/navigationUnlogged.inc.php");
    }
} else {
    include($rootdir . "style/navigationUnlogged.inc.php");
}
?>
