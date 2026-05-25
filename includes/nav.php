<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="site-header lv4-header">
    <h1>Filmoteka</h1>
    <p>LV4 PHP + MySQL aplikacija</p>
</header>

<div class="nav-wrapper lv4-nav-wrapper">
    <button class="menu-toggle" aria-label="Prikaži navigaciju">☰ Menu</button>

    <nav class="main-nav" aria-label="Glavna navigacija">
        <ul>
            <li><a href="index.php">Početna</a></li>
            <li><a href="movies.php">Filmovi iz baze</a></li>
            <li><a href="add_movie.php">Dodaj film</a></li>
            <li><a href="my_movies.php">Moja videoteka</a></li>
            <li><a href="gallery.php">Ocjenjivanje slika</a></li>
            <li><a href="upload_photo.php">Dodaj sliku</a></li>
            <li><a href="grafikon.html">Grafikon</a></li>

            <?php if (isset($_SESSION["user_id"])): ?>
                <li class="nav-user">Pozdrav, <?php echo htmlspecialchars($_SESSION["username"]); ?></li>
                <li><a href="logout.php">Odjava</a></li>
            <?php else: ?>
                <li><a href="login.php">Prijava</a></li>
                <li><a href="register.php">Registracija</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
