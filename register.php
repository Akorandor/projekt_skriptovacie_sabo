<link rel="stylesheet" href="assets/css/admin.css">


<?php
// Spracovanie odoslaného registračného formulára
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získanie údajov z formulára
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validácia údajov (môžete pridať ďalšie validácie podľa potreby)
    $errors = [];

    // Kontrola, či sú všetky polia vyplnené
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($email) ) {
        $errors[] = "Všetky polia musia byť vyplnené.";
    }

    // Kontrola, či sa heslá zhodujú
    if ($password !== $confirmPassword) {
        $errors[] = "Heslá sa nezhodujú.";
    }

    // Ak nie sú žiadne chyby, môžete vykonať registráciu
    if (empty($errors)) {
        include 'inc/register_data.php';

        // Po úspešnej registrácii presmerujte používateľa na prihlasovaciu stránku
        header("Location: login.php");
        exit();
    }
}

include 'partials/register_formular.php';


if (!empty($errors)): ?>
    <div>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
