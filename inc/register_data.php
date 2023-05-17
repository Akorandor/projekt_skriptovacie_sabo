<?php

include 'inc/database.php';

// Premenné z formulára registrácie
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Zabezpečenie vstupných údajov (napr. proti SQL injection)
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$email = mysqli_real_escape_string($conn, $email);

// Heslo zahashujeme (napr. pomocou funkcie password_hash())
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// SQL dotaz na vloženie nového používateľa do tabuľky
$sql = "INSERT INTO admin_users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";

if ($conn->query($sql) === TRUE) {
    // Registrácia bola úspešná, presmerovanie na prihlasovaciu stránku
    header("Location: login.php");
    exit();
} else {
    // Chyba pri vykonávaní SQL dotazu
    echo "Chyba pri registrácii: " . $conn->error;
}

// Uzavretie spojenia s databázou
$conn->close();

?>