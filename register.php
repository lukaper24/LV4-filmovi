<?php
session_start();
include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($username) || empty($email) || empty($password)) {
        $message = "Sva polja su obavezna.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email nije ispravan.";
    } elseif (strlen($password) < 6) {
        $message = "Lozinka mora imati barem 6 znakova.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            $message = "Registracija uspješna!";
        } else {
            $message = "Greška: korisničko ime ili email već postoji.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Registracija</h1>

<?php if (!empty($message)): ?>
    <p class="lv4-message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" class="lv4-form">
    <label>Korisničko ime:</label><br>
    <input type="text" name="username"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Lozinka:</label><br>
    <input type="password" name="password"><br><br>

    <button class="lv4-btn" type="submit">Registriraj se</button>
</form>
<br><a class="lv4-btn" href="login.php">Već imaš račun? Prijavi se</a>
</section>

</main>
</body>
</html>