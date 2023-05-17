


<?php include 'inc/database.php'; 


session_start();

// Kontrola, či je používateľ prihlásený
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Používateľ nie je prihlásený, presmerovanie na prihlasovaciu stránku
    header("Location: login.php");
    exit;
}


$username = $_SESSION['username'];

?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <h2>Vitajte v Admin Paneli</h2>
    <?php include 'inc/database.php'; ?>

    <h2>Manažér projektov</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Názov</th>
            <th>Link</th>
            <th>Obrazok</th>
            <th>Popis</th>
            <th>Dátum vytvorenia</th>
            <th>Akcia</th>
        </tr>

        <?php
        // Získanie zoznamu projektov z databázy
        $sql = "SELECT * FROM projekty";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nazov"] . "</td>";
                echo "<td>" . $row["link"] . "</td>";
                echo "<td>" . $row["obrazok"] . "</td>";
                echo "<td>" . $row["popis"] . "</td>";
                echo "<td>" . $row["datum_vytvorenia"] . "</td>";
                echo '<td><a href="edit_project.php?id=' . $row["id"] . '">Upraviť</a> | <a href="adminpanel.php?delete_id=' . $row["id"] . '">Odstrániť</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Žiadne projekty sa nenašli.</td></tr>";
        }

        // Formulár pre pridanie nového projektu
        echo "<tr>";
        echo "<td></td>";
        echo "<form method='POST' action='adminpanel.php'>";
        echo "<td><input type='text' name='nazov' required></td>";
        echo "<td><input type='text' name='link' required></td>";
        echo "<td><input type='text' name='obrazok' required></td>";
        echo "<td><textarea name='popis' required></textarea></td>";
        echo "<td></td>";
        echo "<td><input type='submit' name='add_project' value='Pridať'></td>";
        echo "</form>";
        echo "</tr>";

        // Spracovanie pridania nového projektu
        if (isset($_POST['add_project'])) {
            $nazov = $_POST['nazov'];
            $link = $_POST['link'];
            $obrazok = $_POST['obrazok'];
            $popis = $_POST['popis'];

            $sql = "INSERT INTO projekty (nazov, link, obrazok, popis) VALUES ('$nazov', '$link', '$obrazok', '$popis')";
            $result = $conn->query($sql);

            if ($result) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Chyba pri pridávaní projektu: " . $conn->error;
            }
        }

// Spracovanie odstránenia projektu
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM projekty WHERE id = $delete_id";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Chyba pri odstraňovaní projektu: " . $conn->error;
    }
}

        ?>

</table>
</div>





    </table>
</div>
   
<div class="admin-table">
    <h2>Manažér adminov</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Meno</th>
            <th>Email</th>
            <th>Potvrdenie admina</th>
            <th>Akcia</th>
        </tr>

        <?php
        // Získanie zoznamu adminov z databázy
        $sql = "SELECT * FROM admin_users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["admin_potvrdenie"] . "</td>";
                echo '<td><a href="edit_admin.php?id=' . $row["id"] . '">Upraviť</a> | <a href="adminpanel.php?id=' . $row["id"] . '" onclick="return confirm(\'Naozaj chcete odstrániť tohto admina?\')">Odstrániť</a></td>';
              

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Žiadni admini sa nenašli.</td></tr>";
        }

       
        ?>
    </table>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $adminId = $_GET["id"];

    // Odstránenie admina z databázy
    $sql = "DELETE FROM admin_users WHERE id = '$adminId'";
    $result = $conn->query($sql);

    if ($result) {
        // Úspešné odstránenie admina, refresh stránky
        echo '<script>window.location.href = "adminpanel.php";</script>';
        exit();
    } else {
        // Chyba pri odstraňovaní admina
        echo "Chyba pri odstraňovaní admina.";
    }
}

$conn->close();
?>







    <p><a href="logout.php">Odhlásiť sa</a></p>
</body>
</html>
