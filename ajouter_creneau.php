<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'coachus';

$conn = new mysqli($host,$user,$password,$dbname);

$date = $_POST['date'];
$start_time = $_POST['start-time'];
$end_time = $_POST['end-time'];
$location = $_POST['location'];

$sql = "INSERT INTO disponibilite (date, "