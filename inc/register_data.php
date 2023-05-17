<?php

include 'inc/database.php';

// Premenné z formulára registrácie
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Zabezpečenie vstupných údajov 
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$email = mysqli_real_escape_string($conn, $email);

// Heslo zahashujeme 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO admin_users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";

if ($conn->query($sql) === TRUE) {

    header("Location: login.php");
    exit();
} else {

    echo "Chyba pri registrácii: " . $conn->error;
}


$conn->close();

?>