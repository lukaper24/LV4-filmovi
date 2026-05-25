<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["photo"])) {

        $file = $_FILES["photo"];

        $allowed = ["image/jpeg", "image/png"];

        if (!in_array($file["type"], $allowed)) {
            $message = "Dozvoljeni su samo JPG i PNG.";
        }
        elseif ($file["size"] > 5 * 1024 * 1024) {
            $message = "Slika ne smije biti veća od 5MB.";
        }
        else {

            $filename = time() . "_" . basename($file["name"]);

            $target = "images/gallery/" . $filename;

            if (move_uploaded_file($file["tmp_name"], $target)) {

                $stmt = $conn->prepare(
                    "INSERT INTO photos (filename, uploaded_by)
                     VALUES (?, ?)"
                );

                $stmt->bind_param(
                    "si",
                    $filename,
                    $_SESSION["user_id"]
                );

                $stmt->execute();

                $stmt->close();

                $message = "Slika uspješno uploadana.";
            }
            else {
                $message = "Greška kod uploadanja.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Upload slike</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Dodaj novu sliku</h1>

<?php if (!empty($message)): ?>
    <p class="lv4-message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="lv4-form">

    <input type="file" name="photo" required>

    <br><br>

    <button class="lv4-btn" type="submit">Upload</button>

</form>

<br>

<a class="lv4-btn" href="gallery.php">Galerija</a>

</section>
</main>
</body>
</html>