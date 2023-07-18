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
  var offset = 12; // Définit l'offset initial à 12 (index à partir duquel charger les photos supplémentaires)

  // Attache un gestionnaire d'événement 'click' au bouton avec l'ID 'load-more'
  $('#load-more').click(function() {
    $.ajax({
      url: my_script_vars.ajaxurl, // URL de la requête AJAX
      type: 'POST', // Méthode de la requête AJAX
      data: {
        action: 'load_more_photos', // Action à exécuter dans la fonction PHP
        offset: offset, // Valeur de l'offset à envoyer dans la requête
      },
      success: function(response) {
        $('.photo-grid').append(response); // Ajoute la réponse (les photos) à l'élément avec la classe '.photo-grid'
        offset += 12; // Augmente l'offset de 12 pour les prochains chargements (12 photos à chaque fois)
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


// Détection du clic sur l'icone du menu burger

jQuery(document).ready(function($) {
  $('.burger-icon').click(function() {
    $('.mobile-menu').slideToggle();
  });
});


// Initialisation de Select2 pour modifier la couleur des selects

jQuery(document).ready(function($) {
  $('#category-filter, #format-select, #date-select').select2(); 
});


jQuery(document).ready(function($) {
  // Sélectionnez le troisième champ select
  var $thirdSelect = $('#date-select');

  // Ajoutez une classe CSS personnalisée au conteneur Select2 du troisième select
  $thirdSelect.next('.select2-container').addClass('date-select-container');

  // Déplacez le champ select vers la droite en ajoutant des styles CSS à la classe personnalisée
  $('.date-select-container .select2-selection').css({
    'float': 'right',
    'width': '100%'
  });
});



