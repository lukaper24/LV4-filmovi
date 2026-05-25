<?php
session_start();
include 'includes/db.php';

$sql = "
    SELECT 
        photos.*,
        ROUND(AVG(photo_ratings.rating), 1) AS average_rating,
        COUNT(photo_ratings.id) AS rating_count
    FROM photos
    LEFT JOIN photo_ratings ON photos.id = photo_ratings.photo_id
    GROUP BY photos.id
    ORDER BY photos.created_at DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Ocjenjivanje slika</title>

    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .photo-card {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
        }

        .photo-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 8px;
        }

        select, button {
            padding: 7px;
            margin-top: 8px;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="lv4-body">
<?php include 'includes/nav.php'; ?>
<main class="lv4-container">


<section class="lv4-card">
<h1>Ocjenjivanje fotografija</h1>

<p>
    Korisnici mogu ocijeniti svaku sliku ocjenom od 1 do 5. 
    Ako korisnik ponovno ocijeni istu sliku, njegova ocjena se ažurira.
</p>

<div class="gallery lv4-gallery">

<?php while($photo = mysqli_fetch_assoc($result)): ?>

    <div class="photo-card lv4-photo-card">

        <img src="images/gallery/<?php echo $photo['filename']; ?>" alt="Slika">

        <p>
            <strong>Prosječna ocjena:</strong>
            <?php echo $photo["average_rating"] ? $photo["average_rating"] : "Nema ocjena"; ?>
        </p>

        <p>
            Broj ocjena: <?php echo $photo["rating_count"]; ?>
        </p>

        <?php if (isset($_SESSION["user_id"])): ?>

            <form method="POST" action="rate_photo.php">

                <input type="hidden" name="photo_id" value="<?php echo $photo['id']; ?>">

                <label>Ocijeni:</label><br>

                <select name="rating" required>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                </select>

                <br>

                <button class="lv4-btn" type="submit">Spremi ocjenu</button>

            </form>

        <?php else: ?>

            <p>
                <a href="login.php">Prijavi se za ocjenjivanje</a>
            </p>

        <?php endif; ?>

    </div>

<?php endwhile; ?>

</div>
</section>

</main>
</body>
</html>