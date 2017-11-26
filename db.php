<?php


$connect = mysqli_connect("localhost", "root", "", "groove");

$local = true;


if ($local == true) 
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'groove';
} else if ($local == false) {

    $host = 'localhost';
    $user = 'ibpasha1';
    $pass = 'Newdad123!';
    $db   = 'analoog';

}

//echo $host, $user, $db;

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
 
?>

