<?php
session_start();

// initializing variables
$fullname = "";
$username = "";
$email    = "";
$website = "";
$url = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'seo');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $website = mysqli_real_escape_string($db, $_POST['website']);
  $address = mysqli_real_escape_string($db, $_POST['url']);
  $cw = array("http://", "https://", "wwww", "www.", "/", " ");
  $url = str_replace($cw, "", $address);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fullname)) { array_push($errors, "<b>* Full Name is required</b>"); }
  if (empty($username)) { array_push($errors, "<b>* Username is required</b>"); }
  if (empty($email)) { array_push($errors, "<b>* Email is required</b>"); }
  if (empty($website)) { array_push($errors, "<b>* Website Name is required</b>"); }
  if (empty($url)) { array_push($errors, "<b>* Website Address is required</b>"); }
  if (empty($password_1)) { array_push($errors, "<b>* Password is required</b>"); }
  if ($password_1 != $password_2) {
    array_push($errors, "<b>The two passwords do not match</b>");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' OR url='$url' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "<b>Username already exists</b>");
    }

    if ($user['email'] === $email) {
      array_push($errors, "<b>Email already exists</b>");
    }
    if ($user['url'] === $url) {
      array_push($errors, "<b>This website is already registered</b>");
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO user (fullname, username, email, website, url, password) 
              VALUES('$fullname', '$username', '$email', '$website', '$url', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    header('location: login.php');
    $_SESSION['success'] = "You have successfully registered";
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: welcome.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>