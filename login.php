<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>On-page Analytics</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div id="container">
<div class="header">
<div class="top-head">
    <div class="top-left"><div class="logo"><a href="index">On-page Analytics</a></div></div>
<div class="top-right">
<div id="reg"><a href="register">Register/Login</a></div>
</div>
</div>
</div>
<div class="wrap_1">
<div class="details">
        <table>
            <tr><td colspan="2">
         <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
    </td></tr>
 <form method="post" action="login.php">
    <?php include('errors.php'); ?>
        <tr>
    <div class="input-group">
        <td>
        <label>Username</label>
    </td><td>
        <input type="text" name="username" >
    </td>
    </div>
</tr>
<tr>
    <div class="input-group">
        <td>
        <label>Password</label>
    </td><td>
        <input type="password" name="password">
    </td>
    </div>
</tr><tr>
    <div class="input-group">
        <td colspan="2">
        <button type="submit" class="btn" name="login_user">Login</button>
    </td>
    </div>
</tr>
<tr>
    <td colspan="2">
    <p>
        Not yet a member? <a href="register" title="Register your Account!">Sign up</a>
    </p>
</td>
</tr>
</form>
</table>
</div>
</div>
<div class="footer_short">
<?php include('footer.php') ?>
</div>
</div>
</body>
</html>