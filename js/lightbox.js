jQuery(document).ready(function($) {
    // Afficher la lightbox lorsqu'on clique sur l'icône "plein écran"
    $('.photo-grid, related-block-photos').on('click', '.photo-fullscreen', function(e) {
      e.preventDefault();
      var imageUrl = $(this).closest('.photo').find('img').attr('src');
      $('body').append('<div id="lightbox" class="lightbox"><div class="lightbox-content"><img src="' + imageUrl + '"></div></div>');
      $('#lightbox').fadeIn();
    });
  
    // Fermer la lightbox lorsqu'on clique en dehors de la photo
    $('body').on('click', '#lightbox', function() {
      $(this).fadeOut(function() {
        $(this).remove();
      });
    });
  
    // Empêcher la propagation du clic à l'intérieur de la lightbox
    $('body').on('click', '.lightbox-content', function(e) {
      e.stopPropagation();
    });
  });