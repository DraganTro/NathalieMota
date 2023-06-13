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

jQuery(document).ready(function($) {
  // Ouvrir la popup au clic sur le bouton "Contact"
  $('.contact-button').click(function() {
    $('.popup').show();

    // Pré-remplir automatiquement le champ "RÉF. PHOTO" avec la référence de la photo
    var ref = $(this).data('ref');
    $('.popup input[name="REF. PHOTO"]').val(ref);
  });
});



jQuery(document).ready(function($) {
  var offset = 8;
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
        offset += 8;
      }
    });
  });
});