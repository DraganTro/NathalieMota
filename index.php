<?php get_header(); ?>

<main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) :

        // Afficher les articles de blog en utilisant le modèle de contenu "content.php"
        while ( have_posts() ) :
            the_post();
            get_template_part( 'templates_part/content', get_post_format() );
        endwhile;

        // Ajouter la pagination des articles
        the_posts_pagination( array(
            'prev_text' => __( 'Précédent', 'textdomain' ),
            'next_text' => __( 'Suivant', 'textdomain' ),
        ) );

    else :

        // Si aucun article n'est trouvé, afficher le message d'erreur "Aucun article trouvé"
        get_template_part( 'templates_part/content', 'none' );

    endif; ?>

</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>