<?php
$host     = '127.0.0.1:3307';
$username = 'root';
$password = '';
$dbname   ='bpmsdb';

$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}