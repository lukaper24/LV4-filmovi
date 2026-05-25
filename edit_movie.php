<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

$message = "";

if (!isset($_GET["id"])) {
    die("Film nije pronađen.");
}

$id = intval($_GET["id"]);

$stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Film ne postoji.");
}

$movie = $result->fetch_assoc();

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST["title"]);
    $genre = trim($_POST["genre"]);
    $year = intval($_POST["year"]);
    $country = trim($_POST["country"]);
    $duration = intval($_POST["duration"]);
    $rating = floatval($_POST["rating"]);

    $stmt = $conn->prepare(
        "UPDATE movies
         SET title=?, genre=?, year=?, country=?, duration=?, rating=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "ssisidi",
        $title,
        $genre,
        $year,
        $country,
        $duration,
        $rating,
        $id
    );

    if ($stmt->execute()) {
        $message = "Film uspješno ažuriran.";

        header("Location: movies.php");
        exit();
    } else {
        $message = "Greška kod ažuriranja.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi film</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Uredi film</h1>

<?php if (!empty($message)): ?>
    <p class="lv4-message"><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" class="lv4-form">

    <label>Naslov:</label><br>
    <input type="text" name="title"
           value="<?php echo $movie['title']; ?>"><br><br>

    <label>Žanr:</label><br>
    <input type="text" name="genre"
           value="<?php echo $movie['genre']; ?>"><br><br>

    <label>Godina:</label><br>
    <input type="number" name="year"
           value="<?php echo $movie['year']; ?>"><br><br>

    <label>Država:</label><br>
    <input type="text" name="country"
           value="<?php echo $movie['country']; ?>"><br><br>

    <label>Trajanje:</label><br>
    <input type="number" name="duration"
           value="<?php echo $movie['duration']; ?>"><br><br>

    <label>Ocjena:</label><br>
    <input type="number" step="0.1" name="rating"
           value="<?php echo $movie['rating']; ?>"><br><br>

    <button class="lv4-btn" type="submit">Spremi promjene</button>

</form>

<br><a class="lv4-btn" href="movies.php">Natrag na filmove</a>
</section>
</main>
</body>
</html>