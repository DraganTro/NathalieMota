<?php get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates_part/content', 'page'); ?>
        <?php if (comments_open() || get_comments_number()) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; endif; ?>
</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>