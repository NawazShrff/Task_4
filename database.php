
<?php
$servername = "localhost";
$username = "nawaz";
$password = "nawaz";
$dbname = "resume";

$conn = mysqli_connect($severname,$username,$password,$dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>