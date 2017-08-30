<table>
    <tr>
        <td>
            Username:
        </td>
        <td>
            <?php echo $_SESSION['username'];?>
        </td>
    </tr>
    <tr>
        <td>
            First Name:
        </td>
        <td>
            <?php if(!is_null($_SESSION['firstName'])){
                echo $_SESSION['firstName'];
            } else {
                echo "Unknown";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Last Name:
        </td>
        <td>
            <?php if(!is_null($_SESSION['lastName'])){
                echo $_SESSION['lastName'];
            } else {
                echo "Unknown";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            E-mail:
        </td>
        <td>
            <?php echo $_SESSION['email']; ?>
        </td>
    </tr>
    <tr>
        <td>
            Timeout Time*:
        </td>
        <td>
            <?echo $_SESSION['timeoutTime'] . " seconds"; ?>
        </td>
    </tr>
</table>
<p>
    * The Timeout Time is how long you will stay logged in after your last browse to another page on the website. Everytime you visit another page, 
    the Timeout Time will be added to the current time (in seconds) so that you won't have to log in every time you visit a members page, 
    or any page that adds some sort of additional functions only for members.
</p>