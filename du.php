<?php 
	$db = mysqli_connect('localhost', 'root', '', 'seo');
	$username = $_SESSION['username'];
    $result = mysqli_query($db, "SELECT * FROM user WHERE username='$username'");
    while ($row = $result->fetch_assoc()) {
    $fullname= $row['fullname'];
    $website= $row['website'];
    $url= $row['url'];
    $email= $row['email'];
}
?>