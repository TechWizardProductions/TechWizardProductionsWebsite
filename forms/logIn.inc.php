<form name="logIn" action="<?php echo $rootdir; ?>forms/logIn.php" method="post">
    <table>
        <tr>
            <td> Username: </td>
            <td> <input type=text name="username"> </td>
        </tr>
        <tr>
            <td> Password: </td>
            <td> <input type=password name="password"> </td>
        </tr>
    </table>
    <input type=submit value= "Log in" name="Log in">  
</form>