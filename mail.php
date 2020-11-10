<?php include('du.php') ?>
<?php 
if (isset($_POST['submit'])) {
    $to = "akarshc1997@gmail.com"; 
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $from = $email;
    $headers = "From:" . $from;

    if (mail($to, $subject, $message, $headers)) {
        echo "Message Sent.";
    }
    else {
        echo "failed";
    }
}

?>