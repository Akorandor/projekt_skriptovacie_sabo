<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $website = $_POST['website'];
    $phone_number = $_POST['phone-number'];
    $full_name = $_POST['full-name'];

    // Uloženie údajov do databázy
    $sql = "INSERT INTO faq (email, website, phone_number, full_name) VALUES ('$email', '$website', '$phone_number', '$full_name')";
    if ($conn->query($sql) === true) {
        echo "Informácie boli úspešne uložené.";
    } else {
        echo "Chyba pri ukladaní informácií: " . $conn->error;
    }
}

$conn->close();
header('Location: ../tx2.php');
exit();
?>
