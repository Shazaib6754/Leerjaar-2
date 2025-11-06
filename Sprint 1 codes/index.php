<?php
require_once 'film.php';
require_once 'acteur.php';
require_once 'filmacteur.php';

// Film toevoegen
if (isset($_POST['add_film'])) {
    Film::add($_POST['titel'], $_POST['genre']);
}

// Acteur toevoegen
if (isset($_POST['add_acteur'])) {
    Acteur::add($_POST['naam']);
}

// Acteur koppelen aan film
if (isset($_POST['link'])) {
    FilmActeur::link($_POST['film_id'], $_POST['acteur_id']);
}

$films = Film::all();
$acteurs = Acteur::all();
?>
<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="style.css">
    <title>Films & Acteurs</title>
    <style>
    </style>
</head>
<body>
    <h1>🎬 Films & Acteurs</h1>

    <h2>Film toevoegen</h2>
    <form method="POST">
        <input type="text" name="titel" placeholder="Titel" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <button name="add_film">Toevoegen</button>
    </form>

    <h2>Acteur toevoegen</h2>
    <form method="POST">
        <input type="text" name="naam" placeholder="Acteurnaam" required>
        <button name="add_acteur">Toevoegen</button>
    </form>

    <h2>Acteur koppelen aan film</h2>
    <form method="POST">
        <select name="film_id" required>
            <option value="">-- Kies een film --</option>
            <?php foreach($films as $film): ?>
                <option value="<?= $film['id'] ?>"><?= htmlspecialchars($film['titel']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="acteur_id" required>
            <option value="">-- Kies een acteur --</option>
            <?php foreach($acteurs as $acteur): ?>
                <option value="<?= $acteur['id'] ?>"><?= htmlspecialchars($acteur['naam']) ?></option>
            <?php endforeach; ?>
        </select>
        <button name="link">Koppelen</button>
    </form>

    <h2>Overzicht films</h2>
    <?php foreach($films as $film): ?>
        <div class="film">
            <strong><?= htmlspecialchars($film['titel']) ?></strong> (<?= htmlspecialchars($film['genre']) ?>)
            <br><em>Acteurs:</em>
            <ul>
                <?php 
                $actors = FilmActeur::getActorsByFilm($film['id']);
                if (empty($actors)) {
                    echo "<li>Geen acteurs gekoppeld</li>";
                } else {
                    foreach($actors as $a) {
                        echo "<li>" . htmlspecialchars($a['naam']) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    <?php endforeach; ?>
</body>
</html>
