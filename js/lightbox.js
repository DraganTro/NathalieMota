jQuery(document).ready(function($) {
  // Afficher la lightbox lorsqu'on clique sur l'icône "plein écran"
  $(document).on('click', '.photo-fullscreen', function(e) {
    e.preventDefault();
    var $currentPhoto = $(this).closest('.photo');
    var $photos = $('.photo');
    var imageUrl = $currentPhoto.find('img').attr('src');
    var currentIndex = $currentPhoto.index('.photo');

    var reference = $currentPhoto.data('reference');
    var category = $currentPhoto.attr('data-categorie');

    // Récupérer les valeurs de référence et de catégorie de la photo actuelle
    var storedReference = reference !== undefined ? reference : '<?php echo get_field("reference", $post->ID); ?>';
    var storedCategory = category !== undefined ? category : '<?php echo get_the_terms($post->ID, "categorie")[0]->name; ?>';

    $('body').append('<div id="lightbox" class="lightbox"><div class="lightbox-content"><img src="' + imageUrl + '"><div class="photo-details"><p class="photo-reference"></p><p class="photo-category"></p></div><a href="#" class="prev-photo"><span>Précédente</span><i class="fa-solid fa-arrow-left"></i></a><a href="#" class="next-photo"><span>Suivante</span><i class="fa-solid fa-arrow-right"></i></a><a href="#" class="close-lightbox"><i class="fa-solid fa-xmark"></i></a></div></div>');

    // Afficher les valeurs de référence et de catégorie dans la lightbox
    $('.photo-reference').text(storedReference);
    $('.photo-category').text(storedCategory);

    $('#lightbox').fadeIn();

    $('.prev-photo, .next-photo').on('click', function(e) {
      e.preventDefault();
      if ($(this).hasClass('prev-photo')) {
        currentIndex = (currentIndex - 1 + $photos.length) % $photos.length;
      } else {
        currentIndex = (currentIndex + 1) % $photos.length;
      }
      $currentPhoto = $photos.eq(currentIndex);
      
      var imageUrl = $currentPhoto.find('img').attr('src');
      var reference = $currentPhoto.data('reference');
      var category = $currentPhoto.attr('data-categorie');

      $('.lightbox-content img').attr('src', imageUrl);
      $('.photo-reference').text(reference);
      $('.photo-category').text(category);
    });

    $('.close-lightbox').on('click', function(e) {
      e.preventDefault();
      $('#lightbox').fadeOut(function() {
        $(this).remove();
      });
    });
  });

  // Empêcher la propagation du clic à l'intérieur de la lightbox
  $(document).on('click', '.lightbox-content', function(e) {
    e.stopPropagation();
  });
});






