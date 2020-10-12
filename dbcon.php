<?php
//mysql_select_db('capstone',mysql_connect('localhost','root','RC1135351'))or die(mysql_error());
$servername = "localhost";
$username = "root";
$password = "RC1135351";
$dbname = "famous_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>