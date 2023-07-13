<?php
/*
Template Name: Blog Page
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'templates_part/content', 'list' ); ?>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else : ?>

            <?php get_template_part( 'templates_part/content', 'none' ); ?>

        <?php endif; ?>

    </main>
</div>

<?php get_sidebar();
get_footer();
?>
