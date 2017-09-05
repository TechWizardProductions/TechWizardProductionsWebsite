<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
        $rootdir = '../';
    ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $rootdir; ?>style/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $rootdir; ?>images/logoSmall.ico">
    <title>Contact | TechWizard Productions</title>
</head>
<body>
    <?php
        include($rootdir . "style/header.inc.php");

        include($rootdir . "style/navigation.inc.php");

    ?>
    <div id="content">
<?php
/*  Last edited on 05/09/2017 */
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $topic = strip_tags($_POST['topic']);
    $subject = strip_tags($_POST['subject']);
    $message = strip_tags($_POST['message']);
    $date = date('d-m-Y') . ' at '. date('H:i');
    $sender = 'auto-reply@techwizardproductions.net16.net';
    $recipient = 'techwizardproductions@gmail.com';

    /* Array with the names of the topics, transforms a number into text */
    $topicName = array();
    $topicName[1] = 'Business';
    $topicName[2] = 'Bug Report';
    $topicName[3] = 'Copyright Violation';
    $topicName[4] = 'Suggestion';
    $topicName[5] = 'Other';

    if(strlen($name) == 0){
        $errorMsg = 'With whom do I have the pleasure of talking to? Please enter your name. <br />';
    }
    if (strlen($email) == 0){
        $errorMsg.= 'Who do I need to send my reply to? Please enter your E-mail address. <br />';
    }
    if (strlen($topic) == 0){
        $errorMsg.= 'It is hard to talk about something we don\'t know about. Please enter the subject. <br />';
    }
    if (strlen($message) == 0){
        $errorMsg.= 'You can not send nothing to TWP. Please enter your message. <br></br>';
    }
    if (isset($errorMsg)){
        /* One of the fields of the form hasn't been filled in correctly. */
        $msg = 'Your message has not been sent due to: <br></br>';
        $msg.= $errorMsg;
        $msg = 'Please <a href=javascript:history.back(1)>return</a> and fill in every field of the form.';

    } else {
        $subjectmail = 'Website: ' . $topicName[$topic] . ' - ' . $subject;
        $header = 'From: ' . $email . "\r\n";
        $header .= "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mailBody = "This message has been sent on " . $date . ". <br />";
        $mailBody .= "It was sent by: " . $name . ".<br />";
        $mailBody .= "You can reply to: " . $email . ".<br></br>";
        $mailBody .= $message;
        $mailBody .= "<br></br> End of the message.";

        mail($recipient, $subjectmail, $mailBody, $header);

        $subjectCM = 'Confirmation of recieving your message';
        $headerCM = 'From: ' . $sender . "\r\n";
        $headerCM .= "MIME-Version: 1.0" . "\r\n";
        $headerCM .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mailCMBody = "Dear " . $name . ".<br></br>";
        $mailCMBody.= "Thank you for sending your message. Hereby we confirm that your message has been processed by our sytems. You can expect a reply within two weeks.<br />";
        $mailCMBody.= "Please do not reply to this E-mail. This is an automatically generated message.<br></br>";
        $mailCMBody.= "With kind regards, <br />";
        $mailCMBody.= 'TechWizard Productions';

        mail($email, $subjectCM, $mailCMBody, $headerCM);

        $msg = 'Your message has been processed succesfully. A confirmation E-mail has been sent to you as well.';
    }
            echo '<br></br>';
            echo '<br />';
            echo $msg;
            include($rootdir . "style/footer.inc.php");
        ?>
    </div>
</body>
</html>