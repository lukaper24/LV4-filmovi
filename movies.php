<?php
session_start();

include 'includes/db.php';

$genre = "";
$year = "";

$sql = "SELECT * FROM movies WHERE 1";

if (isset($_GET["genre"]) && !empty($_GET["genre"])) {

    $genre = trim($_GET["genre"]);

    $sql .= " AND genre LIKE '%$genre%'";
}

if (isset($_GET["year"]) && !empty($_GET["year"])) {

    $year = intval($_GET["year"]);

    $sql .= " AND year >= $year";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Filmovi</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: lightgray;
        }

        form {
            margin-bottom: 20px;
        }

        input {
            padding: 8px;
            margin-right: 10px;
        }

        button {
            padding: 8px 15px;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">

<section class="lv4-card">
<h1>Popis filmova iz baze</h1>

<form method="GET" class="lv4-inline-form">

    <input type="text" name="genre" placeholder="Žanr">

    <input type="number" name="year" placeholder="Godina od">

    <button type="submit">Filtriraj</button>

</form>

<table class="lv4-table">

    <tr>
        <th>Naslov</th>
        <th>Žanr</th>
        <th>Godina</th>
        <th>Država</th>
        <th>Trajanje</th>
        <th>Ocjena</th>
        <th>Akcije</th>

    </tr>

    <?php while($movie = mysqli_fetch_assoc($result)): ?>

        <tr>
    <td><?php echo $movie['title']; ?></td>
    <td><?php echo $movie['genre']; ?></td>
    <td><?php echo $movie['year']; ?></td>
    <td><?php echo $movie['country']; ?></td>
    <td><?php echo $movie['duration']; ?> min</td>
    <td><?php echo $movie['rating']; ?></td>

    <td>

    <a href="edit_movie.php?id=<?php echo $movie['id']; ?>">
        Uredi
    </a>

    |

    <a href="delete_movie.php?id=<?php echo $movie['id']; ?>"
       onclick="return confirm('Jesi siguran da želiš obrisati ovaj film?');">
       Obriši
    </a>

    |
    <a href="add_to_videoteka.php?id=<?php echo $movie['id']; ?>">
        Dodaj u moju videoteku
    </a>

</td>
</tr>

    <?php endwhile; ?>

</table>
</section>

</main>
</body>
</html>