<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "
    SELECT movies.*
    FROM desired_movies
    JOIN movies ON desired_movies.movie_id = movies.id
    WHERE desired_movies.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Moja videoteka</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Moja videoteka</h1>

<?php if (isset($_GET["low_rating"])): ?>
    <p class="lv4-warning">
        Upozorenje: ovaj film ima prosječnu ocjenu ispod 5.0.
    </p>
<?php endif; ?>

<table class="lv4-table">
    <tr>
        <th>Naslov</th>
        <th>Žanr</th>
        <th>Godina</th>
        <th>Država</th>
        <th>Trajanje</th>
        <th>Ocjena</th>
    </tr>

    <?php while($movie = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $movie["title"]; ?></td>
            <td><?php echo $movie["genre"]; ?></td>
            <td><?php echo $movie["year"]; ?></td>
            <td><?php echo $movie["country"]; ?></td>
            <td><?php echo $movie["duration"]; ?> min</td>
            <td><?php echo $movie["rating"]; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<br>
<a class="lv4-btn" href="movies.php">Natrag na filmove</a>

</section>
</main>
</body>
</html>