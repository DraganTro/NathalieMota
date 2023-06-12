<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Ajoutez le contenu de l'article de blog individuel ici -->

    <?php endwhile; endif; ?>

<?php get_footer(); ?>