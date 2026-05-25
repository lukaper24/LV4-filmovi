<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $photo_id = intval($_POST["photo_id"]);
    $rating = intval($_POST["rating"]);
    $user_id = $_SESSION["user_id"];

    if ($rating >= 1 && $rating <= 5) {

        $stmt = $conn->prepare(
            "INSERT INTO photo_ratings
            (user_id, photo_id, rating)
            VALUES (?, ?, ?)

            ON DUPLICATE KEY UPDATE
            rating = VALUES(rating)"
        );

        $stmt->bind_param(
            "iii",
            $user_id,
            $photo_id,
            $rating
        );

        $stmt->execute();

        $stmt->close();
    }
}

header("Location: gallery.php");
exit();
?>