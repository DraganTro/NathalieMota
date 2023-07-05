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

<?php if (isset($_GET['image_url'])) : ?>
  <div id="lightbox" class="lightbox">
    <div class="lightbox-content">
      <img src="<?php echo esc_url($_GET['image_url']); ?>" alt="<?php the_title(); ?>">
      <div class="photo-details">
        
      </div>
      <a href="#" class="prev-photo"><span>Précédente</span><i class="fa-solid fa-arrow-left"></i></a>
      <a href="#" class="next-photo"><span>Suivante</span><i class="fa-solid fa-arrow-right"></i></a>
      <a href="#" class="close-lightbox"><i class="fa-solid fa-xmark"></i></a>
    </div>
  </div>
<?php endif; ?>













<?php wp_footer(); ?>
</body>
</html>