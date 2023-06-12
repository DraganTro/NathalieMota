<!-- Ajoutez le contenu du pied de page ici -->


<?php get_template_part( 'templates_part/modal-contact' ); ?>

<footer>
    <div class="container-footer">
        <div class="row-footer">
            <div class="col-md-12 text-center">
                <ul class="footer-menu">
                    <li><a href="/mentions-legales">Mentions légales</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Vie privée</a></li>
                    <li>Tous droits réservés</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>