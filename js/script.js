// Récupérer la modale et le bouton pour l'ouvrir
var modal = document.getElementById("contactModal");
var btn = document.getElementById("contactBtn");

// Récupérer l'élément <span> qui permet de fermer la modale
var span = document.getElementsByClassName("close")[0];

// Quand l'utilisateur clique sur le bouton, ouvrir la modale 
btn.onclick = function() {
  modal.style.display = "block";
}

// Quand l'utilisateur clique sur <span> (x), fermer la modale
span.onclick = function() {
  modal.style.display = "none";
}

// Quand l'utilisateur clique en dehors de la modale, fermer la modale
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Fonction charger plus
jQuery(document).ready(function($) {
  var offset = 12;
  $('#load-more').click(function() {
    $.ajax({
      url: my_script_vars.ajaxurl,
      type: 'POST',
      data: {
        action: 'load_more_photos',
        offset: offset,
      },
      success: function(response) {
        $('.photo-grid').append(response);
        offset += 12;
      }
    });
  });
});

// Fonction des filtres et tri pour la recherche
jQuery(document).ready(function($) {
  // Gérer le changement de filtre de catégorie
  $('#category-filter').change(function() {
    var category = $(this).val();
    var format = $('#format-select').val();
    var sortOrder = $('#date-select').val();

    filterPhotos(category, format, sortOrder);
  });

  // Gérer le changement de filtre de format
  $('#format-select').change(function() {
    var category = $('#category-filter').val();
    var format = $(this).val();
    var sortOrder = $('#date-select').val();

    filterPhotos(category, format, sortOrder);
  });

  // Gérer le changement du tri de date
  $('#date-select').change(function() {
    var category = $('#category-filter').val();
    var format = $('#format-select').val();
    var sortOrder = $(this).val();

    filterPhotos(category, format, sortOrder);
  });

  function filterPhotos(category, format, sortOrder) {
    $.ajax({
      url: my_script_vars.ajaxurl,
      type: 'POST',
data: {
        action: 'filter_photos',
        category: category,
        format: format,
        sortOrder: sortOrder
      },
      success: function(response) {
        $('.photo-grid').html(response);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError);
      }
    });
  }
});

