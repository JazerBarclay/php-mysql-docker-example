<?php
$host='db'; // Docker compose service name
$user='devuser'; // SQL env username
$pass='devpass'; // SQL env password
$db='test_db'; // SQL env db name

$conn = new mysqli($host,$user,$pass,$db);

// If there was an error connecting show error, if not then print success
if ($conn->connect_error)
    echo 'Connection Failed - ' . $conn->connect_error;
else
    echo 'Connection Successful';

?>
