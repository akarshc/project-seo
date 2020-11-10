<?php include('server.php') ?>
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
<div id="reg"><a href="login">Register/Login</a></div>
</div>
</div>
</div>
<div class="wrap_1">
<div class="details">
	  	 <table>
        <tr><td colspan="2"><h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p></td></tr>
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
          <tr>
    <div class="input-group">
      <td>
      <label>Full Name</label>
    </td>
    <td>
      <input type="text" name="fullname" value="<?php echo $fullname; ?>">
    </td>
    </div>
  </tr>
        <tr>
    <div class="input-group">
        <td>
      <label>Username</label>
    </td>
    <td>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </td>
    </div>
  </tr>
  <tr>
    <div class="input-group">
        <td>
      <label>Email</label>
    </td><td>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </td>
    </div>
  </tr>
  <tr>
    <div class="input-group">
        <td>
      <label>Website Title</label>
    </td><td>
      <input type="text" name="website" value="<?php echo $website; ?>">
    </td>
    </div>
  </tr>
  <tr>
    <div class="input-group">
        <td>
      <label>Website URL</label>
    </td><td>
      <input type="text" name="url" value="<?php echo $url; ?>">
    </td>
    </div>
  </tr>
    <tr>
    <div class="input-group">
        <td>
      <label>Password</label>
    </td><td>
      <input type="password" name="password_1">
    </td>
    </div>
  </tr>
  <tr>
    <div class="input-group">
        <td>
      <label>Confirm password</label>
    </td><td>
         <input type="password" name="password_2">
     </td>
    </div>
  </tr><tr>
    <div class="input-group">
        <td colspan="2">
      <button type="submit" class="btn" name="reg_user" width:100%>Register</button>
    </td>
    </div>
  </tr>
  <tr>
    <td colspan="2">
    <p>
        Already a member? <a href="login">Sign in</a>
    </p>
  </td>
</tr>
  </form>
</table>
    </div>    
</div>
</div>
</div>
    <div class="footer_long">
<?php include('footer.php') ?>
</div>
</body>
</html>