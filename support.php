<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php include('du.php') ?>
<?php 
    $subject = "";
    $message = "";
    $errors = array();
    if (isset($_POST['msg'])) {
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $message = mysqli_real_escape_string($db, $_POST['message']);
    if (empty($subject)) { array_push($errors, "<b>* Type some subject</b>"); }
    if (empty($message)) { array_push($errors, "<b>* Write some message</b>"); }
    if (count($errors) == 0) {
    $query = "INSERT INTO messages (Name, Email, Subject, Message) 
              VALUES('$fullname', '$email', '$subject', '$message')";
    mysqli_query($db, $query);
    $_SESSION['message'] = "Your Message is successfully sent.";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>On-page Analytics</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="header">
<div class="top-head">
    <div class="top-left"><div class="logo"><a href="index">On-page Analytics</a></div></div>
<div class="top-right">
<div id="reg"><a href="Logout">Logout</a></div>
</div>
</div>
</div>
<div class="wrap">
<div class="details">
	    <div class="sidebar">
        <li><a href="welcome">Home</a></li>
        <li><a href="analyse">Analyse SEO</a></li>
        <li><a id="sidebaractive" href="support">Support</a></li>
    </div>
    <div class="content">
<h2>SEO Support</h2>
<p><i>Leave the question and we'll shoot the answer via your email.</i></p>
<form action=" " method="POST">
<table>
<?php include('errors.php'); ?>
<tr><td><input type="text" name="subject" placeholder="Subject"></td></tr>
<tr><td><textarea  name="message" maxlength="1000" cols="100" rows="16" placeholder="Message" class="msg"></textarea></td></tr>
<tr><td><input type="submit" name="msg" class="button"></td></tr>
</table>
</form>
</div>
</div>
<div class="footer_long">
<?php include('footer.php') ?>
</div>
</html>