<?php
include 'includes/db.php';

$file = fopen("movies.csv", "r");

if (!$file) {
    die("Ne mogu otvoriti movies.csv");
}

// preskoči prvi redak: zaglavlje
fgetcsv($file);

$count = 0;

while (($data = fgetcsv($file)) !== false) {
    $title = $data[0];
    $genre = $data[1];
    $year = intval($data[2]);
    $duration = intval($data[3]);
    $rating = floatval($data[4]);
    $director = $data[5];
    $country = $data[6];

    $stmt = $conn->prepare(
        "INSERT INTO movies (title, genre, year, country, duration, rating, director)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssisids",
        $title,
        $genre,
        $year,
        $country,
        $duration,
        $rating,
        $director
    );

    if ($stmt->execute()) {
        $count++;
    }

    $stmt->close();
}

fclose($file);

echo "Import završio. Dodano filmova: " . $count;
?>