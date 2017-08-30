<form name="contact" action="<?php echo $rootdir; ?>forms/contact.php" method="post">
    <!-- Last edited on 16/03/2017 -->
    <table>
        <tr>
            <td> Name: </td>
            <td> <input type=text name="name"> </td>
        </tr>
        <tr>
            <td> E-mail address: </td>
            <td> <input type=text name="email"> </td>
        </tr>
        <tr>
        <?php
            if ($_SESSION['auth'] == true && $_SESSION['timeout'] >= time()){
                echo '<td> Topic: </td>
                      <td> <select name="topic" size=1>
                        <option value=1 selected>Business</option>
                        <option value=2>Bug Report</option>
                        <option value=3>Copyright violation</option>
                        <option value=4>Suggestion</option>
                        <option value=5>Other</option>
                      </select>
                      </td>';
            } else {
                echo '<td> Topic: </td>
                      <td> <select name="topic" size=1>
                        <option value=1 selected>Business</option>
                        <option value=2>Bug Report</option>
                        <option value=3>Copyright violation</option>
                      </select>
                      </td>';
            }
            
        ?>
        </tr>
        <tr>
            <td> Subject: </td>
            <td> <input type=text name="subject"> </td>
        </tr>
        <tr>
            <td> Message: </td>
            <td> <textarea name="message" placeholder="Enter your message here."></textarea> </td>
        </tr>
        <tr>
            <td> <input type=submit value="Submit" name="send"> </td>
        </tr>
    </table>
</form>