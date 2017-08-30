<form name="register" action="<?php echo $rootdir; ?>forms/register.php" method="post" id="register">
    <table>
        <tr>
            <td> Username: </td>
            <td> <input type=text name="username"> </td>
        </tr>
        <tr>
            <td> First name: </td>
            <td> <input type=text name="firstName"> </td>
        </tr>
        <tr>
            <td> Last name: </td>
            <td> <input type=text name="lastName"> </td>
        </tr>
        <tr>
            <td> E-mail address: </td>
            <td> <input type=text name="email"> </td>
        </tr>
        <tr>
            <td> Password: </td>
            <td> <input type=password name="password"> </td>
        </tr>
        <tr>
            <td> Password again: </td>
            <td> <input type=password name="passwordA"> </td>
        </tr>
    </table>
    <input type=submit value="Register" name="send">  
</form>