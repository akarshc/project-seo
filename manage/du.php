<?php 
	$db = mysqli_connect('localhost', 'root', '', 'seo');
    $result = mysqli_query($db, "SELECT * FROM user'");
    while ($col = $result->fetch_assoc()) {
    $fullname= $col['fullname'];
    $website= $col['website'];
    $url= $col['url'];
    $email= $col['email'];
}
?>