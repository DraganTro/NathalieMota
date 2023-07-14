<?php
/**
 * Template pour l'affichage d'un article
 */

get_header(); // inclus le fichier header.php du thème

// Boucle WordPress pour afficher le contenu de l'article
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="entry-meta">
          <?php
            printf(
              esc_html__( 'Publié le %s à %s', 'textdomain' ),
              get_the_date(),
              get_the_time()
            );
          ?>
        </div>
      </header>

      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail(); ?>
        </div><!-- .post-thumbnail -->
      <?php endif; ?>

      <div class="entry-content">
        <?php the_content(); ?>

        <?php
          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'textdomain' ),
            'after'  => '</div>',
          ) );
        ?>
      </div>

      <?php if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-area">
          <?php comments_template(); ?>
        </div><!-- .comments-area -->
      <?php endif; ?>
    </article><!-- #post-<?php the_ID(); ?> -->
    <?php
  endwhile;
endif;

get_footer(); // inclus le fichier footer.php du thème

