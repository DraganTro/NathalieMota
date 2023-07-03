<!-- Ajoutez le contenu du pied de page ici -->


<?php get_template_part( 'templates_part/modal-contact' ); ?>

<footer>
    <div class="container-footer">
        <div class="row-footer">
            <div class="col-md-12 text-center">
                <ul class="footer-menu">
                    <li><a href="/mentions-legales">Mentions légales</a></li>
                    <li><a href="privacy-policy/">Vie privée</a></li>
                    <li>Tous droits réservés</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<?php if ( is_singular( 'photos' ) ) : ?>
  <div id="lightbox" class="lightbox">
    <div class="lightbox-content">
      <img src="<?php echo wp_get_attachment_image_url( get_the_ID(), 'full' ); ?>" alt="<?php the_title(); ?>">
    </div>
  </div>
<?php endif; ?>

<?php
function mytheme_enqueue_scripts() {
  wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );
?>

<?php wp_footer(); ?>
</body>
</html>