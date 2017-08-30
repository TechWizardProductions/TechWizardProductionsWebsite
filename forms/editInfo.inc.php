<form name="editInfo" action="<?php echo $rootdir; ?>forms/editInfo.php" method="post" id="editInfo">
    <table>
        <tr>
            <td> Username: </td>
            <td> <input type=text name="username" value="<?php echo $_SESSION['username']; ?>"> </td>
        </tr>
        <tr>
            <td> First name: </td>
            <td> <input type=text name="firstName" value="<?php 
            if (is_null($_SESSION['firstName'])){
                    echo "";
                } else {
                    echo $_SESSION['firstName'];
                } ?>"> </td>
        </tr>
        <tr>
            <td> Last name: </td>
            <td> <input type=text name="lastName" value="<?php 
            if (is_null($_SESSION['lastName'])){
                    echo "";
                } else {
                    echo $_SESSION['lastName'];
                } ?>"> </td>
        </tr>
        <tr>
            <td> E-mail address: </td>
            <td> <input type=text name="email" value="<?php echo $_SESSION['email']; ?>"> </td>
        </tr>
        <tr>
            <td> Password: </td>
            <td> <input type=password name="password" value="<?php echo $_SESSION['password']; ?>"> </td>
        </tr>
        <tr>
            <td> Time-out time: </td>
            <td> <select name="timeout" size=1>
                 <option value=1>900</option>
                 <option value=2>1800</option>
                 <option value=3 selected>3600</option>
                 <option value=4>5400</option>
                 <option value=5>7200</option>
                 </select>
                 Seconds
            </td>
        </tr>
    </table>
    <input type=submit value="Submit Changes" name="send">  
</form>