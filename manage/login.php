<?php include('log.php') ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Panel Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="header">
<div class="top-head">
    <div class="top-left"><div class="logo"><a href="index">On-page Analytics</a></div></div>
</div>
</div>
<div class="wrap">
        <table>
            <tr><td colspan="2">
         <h2>Login</h2>
        <p>Login and manage this website.</p>
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
        <button type="submit" class="btn" name="login_admin">Login</button>
    </td>
    </div>
</tr>
</form>
</table>
</div>
<div class="footer_short">
<?php include('footer.php') ?>
</div>
</body>
</html>