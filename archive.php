<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <header class="page-header">
      <h1 class="page-title">Toutes les photos</h1>
    </header>

    <?php if (have_posts()) : ?>
      <div class="photo-grid photo-grid-archive">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium_large'); ?>
            </a>
          </article>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination(); ?>

    <?php else : ?>
      <p>Aucune photo trouvée.</p>
    <?php endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
