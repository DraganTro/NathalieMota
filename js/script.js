jQuery(document).ready(function($) {
  // Récupérer la modale et les éléments pour l'ouvrir
  var modal = $("#contactModal");
  var btn = $(".open-contact-modal");
  var menuLink = $(".menu-link-contact");

  // Récupérer l'élément <span> qui permet de fermer la modale
  var span = $(".close");

  // Quand l'utilisateur clique sur le bouton, ouvrir la modale
  btn.click(function() {
    // Récupérer la valeur du champ "RÉF. PHOTO"
    var photoRef = $(this).data('photo-ref');

    // Préremplir automatiquement le champ "RÉF. PHOTO" dans le formulaire de contact
    modal.find('input[name="ref-photo"]').val(photoRef);

    // Afficher la modale
    modal.show();
  });

  // Quand l'utilisateur clique sur le lien du menu, ouvrir la modale
  menuLink.click(function(event) {
    event.preventDefault(); // Empêcher le lien de naviguer vers une autre page

    // Afficher la modale
    modal.show();
  });

  // Quand l'utilisateur clique sur <span> (x), fermer la modale
  span.click(function() {
    modal.hide();
  });

  // Quand l'utilisateur clique en dehors de la modale, fermer la modale
  $(window).click(function(event) {
    if (event.target === modal[0]) {
      modal.hide();
    }
  });
});



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




  












