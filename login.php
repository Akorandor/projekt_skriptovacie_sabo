<?php
// Prihlásenie používateľa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'inc/database.php';

    // Premenné z formulára prihlásenia
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Zabezpečenie vstupných údajov 
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Získanie uloženého hesla a hodnoty admin_potvrdenie pre daného používateľa
    $sql = "SELECT password, admin_potvrdenie FROM admin_users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        $adminPotvrdenie = $row["admin_potvrdenie"];

        // Overenie hesla a admin_potvrdenie
        if (password_verify($password, $hashedPassword) && $adminPotvrdenie == true) {
            // Prihlásenie úspešné
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION['loggedin'] = true;
            header("Location: adminpanel.php");
            exit();
        } else {

            $loginError = "Este ste neni priradený ako admin.";
        }
    } else {

        $loginError = "Neplatné používateľské meno alebo heslo.";
    }


    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Prihlásenie</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <h2>Prihlásenie</h2>
    <?php if (isset($loginError)) { echo "<p>$loginError</p>"; } ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Používateľské meno:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Heslo:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Prihlásiť sa">
        
    </form>
    <form action="register.php">
 <p>Nemas este ucet ? Registruj sa</p>
 
    <button type="submit" class="register-button">Registrovať</button>
</form>


</body>
</html>
