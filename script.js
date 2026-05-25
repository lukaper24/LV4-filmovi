let sviFilmovi = [];
let kosarica = [];

/* UČITAVANJE CSV */
fetch("movies.csv")
  .then(response => response.text())
  .then(csv => {
    const rezultat = Papa.parse(csv, {
      header: true,
      skipEmptyLines: true
    });

    sviFilmovi = rezultat.data.map(f => ({
      title: f.Naslov,
      genre: f.Zanr,
      year: Number(f.Godina),
      duration: Number(f.Trajanje_min),
      rating: Number(f.Ocjena),
      country: f.Zemlja_porijekla
    }));

    prikaziTablicu(sviFilmovi);
  })
  .catch(error => {
    console.error("Greška:", error);
  });

/* TABLICA */
function prikaziTablicu(filmovi) {
  const tbody = document.querySelector("#filmovi-tablica tbody");
  tbody.innerHTML = "";

  filmovi.forEach(film => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${film.title}</td>
      <td>${film.year}</td>
      <td>${film.genre}</td>
      <td>${film.duration} min</td>
      <td>${film.country}</td>
      <td>${film.rating}</td>
      <td><button onclick='dodajUKosaricu(${JSON.stringify(film)})'>Dodaj</button></td>
    `;

    tbody.appendChild(row);
  });
}

/* FILTER */
document.getElementById("filter-btn").addEventListener("click", filtriraj);

function filtriraj() {
  const zanr = document.getElementById("filter-genre").value.toLowerCase();
  const godina = document.getElementById("filter-year").value;
  const ocjena = document.getElementById("filter-rating").value;

  const filtrirani = sviFilmovi.filter(film =>
    (!zanr || film.genre.toLowerCase().includes(zanr)) &&
    (!godina || film.year >= Number(godina)) &&
    (film.rating >= Number(ocjena))
  );

  prikaziTablicu(filtrirani);
}

/* SLIDER */
document.getElementById("filter-rating").addEventListener("input", function () {
  document.getElementById("rating-value").textContent = this.value;
});

/* RESET */
document.getElementById("reset-btn").addEventListener("click", function () {
  document.getElementById("filter-genre").value = "";
  document.getElementById("filter-year").value = "";
  document.getElementById("filter-rating").value = 0;
  document.getElementById("rating-value").textContent = "0";

  prikaziTablicu(sviFilmovi);
});

/* DODAVANJE */
function dodajUKosaricu(film) {
  const postoji = kosarica.some(f => f.title === film.title);

  if (!postoji) {
    kosarica.push(film);
    prikaziKosaricu();
  } else {
    alert("Film je već u košarici!");
  }
}

/* PRIKAZ KOŠARICE */
function prikaziKosaricu() {
  const lista = document.getElementById("lista-kosarice");
  lista.innerHTML = "";

  if (kosarica.length === 0) {
    lista.innerHTML = "<li>Košarica je prazna</li>";
  }

  kosarica.forEach((film, index) => {
    const li = document.createElement("li");

    li.innerHTML = `
      ${film.title}
      <button onclick="ukloniIzKosarice(${index})">Ukloni</button>
    `;

    lista.appendChild(li);
  });

  document.querySelector("#kosarica h3").innerText =
    `Moja košarica (${kosarica.length})`;
}

/* UKLANJANJE */
function ukloniIzKosarice(index) {
  kosarica.splice(index, 1);
  prikaziKosaricu();
}

/* POTVRDA */
document.getElementById("potvrdi-kosaricu").addEventListener("click", function () {
  if (kosarica.length === 0) {
    alert("Košarica je prazna!");
  } else {
    alert(`Dodali ste ${kosarica.length} filmova!`);
    kosarica = [];
    prikaziKosaricu();
  }
});