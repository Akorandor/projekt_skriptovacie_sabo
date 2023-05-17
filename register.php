<link rel="stylesheet" href="assets/css/admin.css">


<?php
// Spracovanie odoslaneho registracneho formulara
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získanie údajov z formulára
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validacia udajov
    $errors = [];

    // Kontrola ci su všetky polia vyplnene
    if (empty($username) || empty($password) || empty($confirmPassword) || empty($email) ) {
        $errors[] = "Všetky polia musia byť vyplnené.";
    }


    if ($password !== $confirmPassword) {
        $errors[] = "Heslá sa nezhodujú.";
    }


    if (empty($errors)) {
        include 'inc/register_data.php';


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
