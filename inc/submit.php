<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Uloženie údajov do databázy
    $sql = "INSERT INTO kontakt (name, surname, email, subject, message) VALUES ('$name', '$surname', '$email', '$subject', '$message')";
    if ($conn->query($sql) === true) {
        echo "Správa bola úspešne odoslaná.";
    } else {
        echo "Chyba pri odosielaní správy: " . $conn->error;
    }
}

$conn->close();
header('Location: ../tx.php');
exit();

?>
