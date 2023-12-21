!DOCTYPE html>
<html>

<head>
    <title>Résultats de la Recherche</title>
</head>

<body>
    <h1>Résultats de la Recherche</h1>
    <?php
    // Affiche les résultats de la recherche
    foreach ($recherches as $recherche) {
        echo "<p>" . $recherche . "</p>";
    }
    ?>
</body>

</html>
