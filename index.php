<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responzivna web stranica o filmovima s tablicom, filtriranjem i košaricom.">

    <title>Filmoteka</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- PapaParse za čitanje CSV datoteke -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>
</head>

<body>

<header class="site-header">
    <h1>Filmoteka</h1>
    <p>Pregled filmova, filtriranje i košarica za posudbu</p>
</header>

<div class="nav-wrapper">
    <button class="menu-toggle" aria-label="Prikaži navigaciju">☰ Menu</button>

    <nav class="main-nav" aria-label="Glavna navigacija">
        <ul>
            <li><a href="index.php">Početna</a></li>

            <li><a href="movies.php">Filmovi iz baze</a></li>

            <li><a href="add_movie.php">Dodaj film</a></li>

            <li><a href="my_movies.php">Moja videoteka</a></li>

            <li><a href="grafikon.html">Grafikon</a></li>

            <li><a href="gallery.php">Galerija</a></li>

            <?php if (isset($_SESSION["user_id"])): ?>

                <li>
                    Pozdrav,
                    <?php echo $_SESSION["username"]; ?>
                </li>

                <li>
                    <a href="logout.php">Odjava</a>
                </li>

            <?php else: ?>

                <li>
                    <a href="login.php">Prijava</a>
                </li>

                <li>
                    <a href="register.php">Registracija</a>
                </li>

            <?php endif; ?>
        </ul>
    </nav>
</div>

<main class="page-layout">

    <section class="main-content">
        <article class="intro">
            <h2>O filmovima</h2>
            <p>
                Ova stranica prikazuje filmove iz prethodnih vježbi, a LV4 dio koristi PHP i MySQL
                za trajno spremanje podataka, autentifikaciju korisnika i osobnu videoteku.
            </p>
        </article>

        <!-- LV3 -->
        <article class="movie-table-section" id="lv3">
            <h2>LV3 / LV4 - Virtualna videoteka</h2>

            <div id="filteri">
                <input type="text" id="filter-genre" placeholder="Unesi žanr">

                <input type="number" id="filter-year" placeholder="Godina od">

                <label>
                    Minimalna ocjena:
                    <input type="range" id="filter-rating" min="0" max="10" step="0.1" value="0">
                    <span id="rating-value">0</span>
                </label>

                <button id="filter-btn">Filtriraj</button>
                <button id="reset-btn">Reset</button>
            </div>

            <div class="table-wrapper">
                <table id="filmovi-tablica">
                    <caption>Početni prikaz filmova iz CSV-a; LV4 funkcionalnosti dostupne su kroz PHP/MySQL stranice u navigaciji.</caption>
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            <th>Godina</th>
                            <th>Žanr</th>
                            <th>Trajanje</th>
                            <th>Država</th>
                            <th>Ocjena</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </article>
    </section>

    <aside class="sidebar" aria-label="Dodatni sadržaj o filmovima">
        <h2>Izdvojeni vizuali</h2>

        <picture>
            <source media="(max-width: 768px)" srcset="images/film-mobile.jpg">
            <img src="images/film-desktop.jpg" alt="Ilustracija filmske tematike stranice">
        </picture>

        <p>
            Fotografija se prilagođava veličini ekrana kako bi stranica bila responzivna
            i pregledna na mobilnim i desktop uređajima.
        </p>

        <a class="more-btn" href="gallery.php">Pogledaj galeriju</a>

        <div id="kosarica">
            <h3>Moja košarica</h3>
            <ul id="lista-kosarice"></ul>
            <button id="potvrdi-kosaricu">Potvrdi odabir</button>
        </div>
    </aside>

</main>

<footer class="site-footer">
    <p>&copy; 2025 Filmoteka | Web programiranje</p>
</footer>

<script src="script.js"></script>

</body>
</html>