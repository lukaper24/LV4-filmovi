<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $genre = trim($_POST["genre"]);
    $year = intval($_POST["year"]);
    $country = trim($_POST["country"]);
    $duration = intval($_POST["duration"]);
    $rating = floatval($_POST["rating"]);
    $director = trim($_POST["director"]);

    if (empty($title) || empty($genre) || empty($country) || empty($director) || empty($year) || empty($duration)) {
        $message = "Sva polja osim ocjene su obavezna.";
    } elseif ($year < 1900 || $year > date("Y")) {
        $message = "Godina nije ispravna.";
    } elseif ($duration < 1 || $duration > 500) {
        $message = "Trajanje filma nije ispravno.";
    } elseif ($rating < 0 || $rating > 10) {
        $message = "Ocjena mora biti između 0 i 10.";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO movies (title, genre, year, country, duration, rating, director)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ssisids", $title, $genre, $year, $country, $duration, $rating, $director);

        if ($stmt->execute()) {
            $message = "Film je uspješno dodan.";
        } else {
            $message = "Greška kod dodavanja filma.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj film</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Dodaj novi film</h1>

<?php if (!empty($message)): ?>
    <p class="lv4-message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" class="lv4-form">
    <label>Naslov:</label><br>
    <input type="text" name="title"><br><br>

    <label>Žanr:</label><br>
    <input type="text" name="genre"><br><br>

    <label>Godina:</label><br>
    <input type="number" name="year"><br><br>

    <label>Država:</label><br>
    <input type="text" name="country"><br><br>

    <label>Trajanje u minutama:</label><br>
    <input type="number" name="duration"><br><br>

    <label>Ocjena:</label><br>
    <input type="number" step="0.1" name="rating" value="0"><br><br>

    <label>Redatelj:</label><br>
    <input type="text" name="director"><br><br>

    <button class="lv4-btn" type="submit">Dodaj film</button>
</form>

<br>
<a class="lv4-btn" href="movies.php">Pogledaj filmove</a>

</section>
</main>
</body>
</html>