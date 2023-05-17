<!DOCTYPE html>
<html> 
<head>
    <title>Úprava admina</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <h2>Úprava admina</h2>

    <?php
    include 'inc/database.php';

    // Overenie, či bolo zaslané ID admina
    if (!empty($_GET['id'])) {
        $adminId = $_GET['id'];

        // Získanie údajov o adminovi z databázy
        $sql = "SELECT * FROM admin_users WHERE id = '$adminId'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {

            // Získanie hodnôt stĺpcov pre konkrétnyho admina
            $row = $result->fetch_assoc();
            $adminUsername = $row["username"];
            $adminEmail = $row["email"];
            $adminPotvrdenie = $row["admin_potvrdenie"];
        } else {
            // Admin s daným ID nebol nájdený
            echo "Neplatné ID admina.";
            exit();
        }
    } else {
        // Nezadané ID admina
        echo "Neplatná požiadavka.";
        exit();
    }

    // Spracovanie formulára po kliknutí na tlačidlo "Uložiť"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ) {
            echo "Nemáte oprávnenie na vykonanie tejto akcie.";
            exit();
        }
        

        // Spracovanie údajov z formulára
        $adminPotvrdenie = isset($_POST["admin_potvrdenie"]) ? 1 : 0;

        // Aktualizácia hodnoty admin_potvrdenie v databáze
        $updateSql = "UPDATE admin_users SET admin_potvrdenie = '$adminPotvrdenie' WHERE id = '$adminId'";
        $updateResult = $conn->query($updateSql);

        if ($updateResult) {
            // Aktualizácia úspešná, presmerovanie na adminpanel.php
            header("Location: adminpanel.php");
            exit();
        } else {
            echo "Chyba pri aktualizácii hodnoty admin_potvrdenie.";
        }

        $conn->close();
    }
    ?>

    <form method="POST">
        <div>
            <label>Meno: <?php echo $adminUsername; ?></label>
        </div>
        <div>
            <label>Email: <?php echo $adminEmail; ?></label>
        </div>
        <div>
            <label>
                Potvrdenie admina:
                <input type="checkbox" name="admin_potvrdenie" <?php if ($adminPotvrdenie == 1) echo 'checked'; ?>>
            </label>
        </div>
        <div>
            <input type="submit" value="Uložiť">
        </div>
    </form>

    </body









