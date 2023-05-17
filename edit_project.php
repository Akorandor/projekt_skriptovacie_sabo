<?php
session_start();

// Kontrola prihlásenia
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}



include 'inc/database.php';

// Overenie, či bolo zaslané ID projektu
if (!empty($_GET['id'])) {
    $projectId = $_GET['id'];

    // Získanie údajov o projekte z databázy
    $sql = "SELECT * FROM projekty WHERE id = '$projectId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $project = $result->fetch_assoc();

        // Získanie hodnôt stĺpcov pre konkrétny projekt
        $nazov = $project['nazov'];
        $link = $project['link'];
        $obrazok = $project['obrazok'];
        $popis = $project['popis'];
    } else {
        // Projekt s daným ID nebol nájdený
        echo "Projekt nebol nájdený.";
        exit();
    }
} else {
    // Nezadané ID projektu
    echo "Neplatné ID projektu.";
    exit();
}

// Spracovanie formulára po odoslaní
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získanie aktualizovaných hodnôt z formulára
    $updatedNazov = $_POST['nazov'];
    $updatedLink = $_POST['link'];
    $updatedObrazok = $_POST['obrazok'];
    $updatedPopis = $_POST['popis'];

    // Aktualizácia údajov o projekte v databáze
    $updateSql = "UPDATE projekty SET nazov = '$updatedNazov', link = '$updatedLink', obrazok = '$updatedObrazok', popis = '$updatedPopis' WHERE id = '$projectId'";

    if ($conn->query($updateSql) === TRUE) {
        // Úspešne aktualizované
        header("Location: adminpanel.php");
        exit();
    } else {
        // Chyba pri aktualizácii
        echo "Chyba pri aktualizácii projektu: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upraviť projekt</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <h2>Upraviť projekt</h2>

    <form method="POST">
        <label for="nazov">Názov:</label>
        <input type="text" name="nazov" value="<?php echo $nazov; ?>" required>

        <label for="link">Link:</label>
        <input type="text" name="link" value="<?php echo $link; ?>" required>

        <label for="obrazok">Obrázok:</label>
        <input type="text" name="obrazok" value="<?php echo $obrazok; ?>" required>

        <label for="popis">Popis:</label>
        <textarea name="popis" required><?php echo $popis; ?></textarea>

        <input type="submit" value="Uložiť zmeny">
    </form>
</body
