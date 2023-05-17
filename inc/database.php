<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skriptovacie_jazyky";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Pripojenie zlyhalo: " . $conn->connect_error);
}





