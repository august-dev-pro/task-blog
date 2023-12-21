
// Ce script gère la recherche en temps réel
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez l'élément d'entrée de recherche
    var searchInput = document.querySelector("#searchInput");

    // Sélectionnez l'élément de résultats
    var searchResults = document.querySelector("#searchResults");

    // Ajoutez un écouteur d'événements pour le champ de recherche
    searchInput.addEventListener("input", function () {
        // Récupérez la valeur du champ de recherche
        var searchTerm = searchInput.value;

        // Effectuez une requête AJAX pour rechercher les résultats
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "votre_url_de_recherche.php?q=" + searchTerm, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Analysez la réponse JSON de la requête AJAX
                var results = JSON.parse(xhr.responseText);

                // Générez le HTML des résultats
                var resultsHTML = "";
                results.forEach(function (result) {
                    resultsHTML += "<h2>" + result.titre + "</h2>";
                    resultsHTML += "<p>" + result.contenu + "</p>";
                });

                // Affichez les résultats dans la div des résultats
                searchResults.innerHTML = resultsHTML;
            }
        };

        xhr.send();
    });
});
