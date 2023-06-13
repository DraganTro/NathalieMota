<?php get_header(); ?>

<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
  <h1><?php the_title(); ?></h1>
  <p>Type : <?php the_field('type'); ?></p>
  <p>Référence : <?php the_field('référence'); ?></p>
  <p>Année : <?php the_field('année'); ?></p>
  <p>Format : <?php the_field('format'); ?></p>
  <?php the_post_thumbnail(); ?>
  <?php the_content(); ?>

  <!-- Boucle WP_Query pour récupérer les photos apparentées -->
  <?php
    $terms = get_the_terms( get_the_ID(), 'categorie' );
    $term_slug = $terms[0]->slug;

    $args = array(
      'post_type' => 'photos',
      'posts_per_page' => 3,
      'post__not_in' => array( get_the_ID() ),
      'tax_query' => array(
        array(
          'taxonomy' => 'categorie',
          'field' => 'slug',
          'terms' => $term_slug,
        ),
      ),
    );

    $related_photos = new WP_Query( $args );
  ?>

  <?php if ( $related_photos->have_posts() ) : ?>
    <div class="related-photos">
      <h2>Photos apparentées</h2>

      <ul>
        <?php while ( $related_photos->have_posts() ) : $related_photos->the_post(); ?>
          <?php get_template_part( 'templates_part/photo_block' ); ?>
        <?php endwhile; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php wp_reset_postdata(); ?>
  
  <!-- Boucle WordPress pour afficher les commentaires de la publication -->
  <?php comments_template(); ?>

<?php endwhile; ?>

<button class="contact-button" data-ref="<?php the_field( 'référence' ); ?>">Contact</button>

<?php get_footer(); ?>

<?php get_footer(); ?>