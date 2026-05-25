<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $movie_id = intval($_GET["id"]);
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("SELECT rating FROM movies WHERE id = ?");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    $stmt->close();

    $warning = "";

    if ($movie && $movie["rating"] < 5.0) {
        $warning = "low_rating=1";
    }

    $stmt = $conn->prepare("INSERT IGNORE INTO desired_movies (user_id, movie_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $movie_id);
    $stmt->execute();
    $stmt->close();

    if ($warning != "") {
        header("Location: my_movies.php?" . $warning);
    } else {
        header("Location: my_movies.php");
    }

    exit();
}

header("Location: movies.php");
exit();
?>