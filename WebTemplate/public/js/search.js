$(document).ready(function() {
    $('#search-input').on('keyup', function() {
        var query = $(this).val();
        if (query.length >= 1) {
            search(query);
        }
    });
});

function search(query) {
    $.ajax({
        url: "http://127.0.0.1:8000/produit/search",
        type: "GET",
        data: { name: query },
        dataType: "json",
        success: function(data) {
            // Mettre à jour la vue avec les résultats de la recherche
            // Vider les résultats de la recherche précédente
            $('#ess').empty();

            if (data.resultss.length > 0) {
                $.each(data.resultss, function(index, produit) {
                    var row = '<div>';
                    row += '<h3>' + produit.Codeproduit + '</h3>';
                    row += '<p>' + produit.des + '</p>';
                    row += '</div>';

                    $('#ess').append(row);
                });
            } else {
                // Aucun résultat trouvé, afficher un message d'erreur
                $('#ess').html('Aucun résultat trouvé.');
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
