<?php
session_start();

include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {

        $message = "Sva polja su obavezna.";

    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];

                header("Location: index.php");
                exit();

            } else {

                $message = "Pogrešna lozinka.";
            }

        } else {

            $message = "Korisnik ne postoji.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Prijava</h1>

<?php if (!empty($message)): ?>
    <p class="lv4-message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" class="lv4-form">

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Lozinka:</label><br>
    <input type="password" name="password"><br><br>

    <button class="lv4-btn" type="submit">Prijavi se</button>

</form>
<br><a class="lv4-btn" href="register.php">Nemaš račun? Registriraj se</a>
</section>

</main>
</body>
</html>