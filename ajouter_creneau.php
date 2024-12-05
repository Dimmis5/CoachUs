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

$query = "SELECT id_lieu FROM lieu WHERE nom = ?"

$sql = "INSERT INTO disponibilite (date, heure_debut, heure_fin, id_lieu) VALUES ('date','start-time','end_time,'location')