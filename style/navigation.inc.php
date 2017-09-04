<?php
if(isset($_SESSION['timeout'])){
    $timeout = $_SESSION['timeout'];
}

if(isset($_SESSION['auth'])){
    $auth = $_SESSION['auth'];
}

if(isset($timeout) && isset($auth)){
    if ($auth == true && $timeout >= time()){
        include($rootdir . "style/navigationLogged.inc.php");
        $_SESSION['timeout'] = time() + $_SESSION['timeoutTime'];
    } else {
        include($rootdir . "style/navigationUnlogged.inc.php");
    }
} else {
    include($rootdir . "style/navigationUnlogged.inc.php");
}
?>
