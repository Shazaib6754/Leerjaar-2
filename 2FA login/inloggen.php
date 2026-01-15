<?php
// ==============================
// SESSIE STARTEN
// ==============================
session_start();

// ==============================
// DATABASE VERBINDING
// ==============================
$host = "localhost";
$db   = "jouw_database";
$user = "jouw_gebruiker";
$pass = "jouw_wachtwoord";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $user, $pass, $options);

// ==============================
// GOOGLE AUTHENTICATOR INCLUDEN
// ==============================
require_once 'GoogleAuthenticator.php';

// Namespace toevoegen en classname gebruiken
use PHPGangsta\GoogleAuthenticator;

// Nieuwe instantie maken
$ga = new GoogleAuthenticator();

$error = null;

// ==============================
// FORMULIER VERWERKING
// ==============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $code     = $_POST['code']; // 2FA code

    // Gebruiker ophalen uit database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {

        // Wachtwoord controleren
        if (password_verify($password, $user['password'])) {

            // 2FA secret uit database
            $secret = $user['2fa_secret'];

            // Controleer Google Authenticator code
            $checkResult = $ga->verifyCode($secret, $code, 2);
            // 2 = toegestane tijdsafwijking (30 sec)

            if ($checkResult) {
                // Inloggen gelukt
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Ongeldige 2FA-code.";
            }

        } else {
            $error = "Onjuist wachtwoord.";
        }

    } else {
        $error = "Gebruiker bestaat niet.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login met 2FA</title>
</head>
<body>

<h1>Login</h1>

<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>2FA Code (Google Authenticator):</label><br>
    <input type="text" name="code" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
