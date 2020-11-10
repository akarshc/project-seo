<?php 
  session_name('manage');
  session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<?php include('du.php');?>
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
<div class="wrapper">
<div class="details">
      <div class="sidebar">
        <li><a href="index">Home</a></li>
        <li><a id="sidebaractive" href="users">Users</a></li>
        <li><a href="messages">Messages</a></li>
    </div>
    <div class="content">
<h2 class="conthead">Users</h2>

</div>
</div>
<div class="footer_long">
<?php include('footer.php') ?>
</div>
</body>
</html>