<?php 

session_start(); // Ak ešte nie je spustená session
session_unset(); // Odstráni všetky premenné zo session
session_destroy(); // Zruší session

// Presmerovanie na prihlasovaciu stránku
header("Location: login.php");
exit;

?>