<?php get_header(); ?>

<!-- Template Name: Ma page single-photo personnalisée -->

<div class="photo-info-container">
  <div class="photo-container">
  <div class="photo-info-left">
    <h1><?php the_title(); ?></h1>
    <p>Référence : <?php the_field('reference'); ?></p>
    <p>Catégorie : <?php echo get_the_term_list( get_the_ID(), 'categorie', '', ', ' ); ?></p>
    <p>Format : <?php echo get_the_term_list( get_the_ID(), 'format', '', ', ' ); ?></p>
    <p>Type : <?php the_field('type'); ?></p>
    <p>Année : <?php the_field('annee'); ?></p>
  </div>
  <div class="photo-info-right">
  <?php the_post_thumbnail('full'); ?>
  <a class="fullscreen-link" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>">
    <span></span> 
  </a>
</div>
</div>
  <div class="photo-info-nav">
    <div class="photo-info-interest">
      <p>Cette photo vous intéresse ?</p>
    </div>
    
    <button id="contactBtn" class="photo-contact-btn open-contact-modal" data-photo-ref="<?php the_field('reference'); ?>">Contact</button>

    <div class="photo-info-nav-block">

    <div class="photo-info-nav-prev">   
      <!-- Miniature précédente -->
      <div class="thumbnail-previous">
      <?php $prev_post = get_previous_post(); ?>
      <?php if ($prev_post) : ?>
        <img class="nav-thumbnail-prev" src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id($prev_post->ID), 'thumbnail' ); ?>" alt="<?php echo $prev_post->post_title; ?>">
      <?php endif; ?>
      </div>
      <?php previous_post_link('%link', '<img src="/wp-content/themes/NathalieMota/images/arrow_left.svg" alt="Précédent">', FALSE, '', 'format'); ?>
    </div>

    <div class="photo-info-nav-next">    
      <!-- Miniature suivante -->
      <div class="thumbnail-next">
      <?php $next_post = get_next_post(); ?>
      <?php if ($next_post) : ?>
        <img class="nav-thumbnail-next" src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id($next_post->ID), 'thumbnail' ); ?>" alt="<?php echo $next_post->post_title; ?>">
      <?php endif; ?>
      </div>
      <?php next_post_link('%link', '<img src="/wp-content/themes/NathalieMota/images/arrow_right.svg" alt="Suivant">', FALSE, '', 'format'); ?>
    </div>

    </div>

  </div>
</div>
<!-- Mise en place du bloc des photos apparentées -->
<div class="related-photos">
  <h2>Vous aimerez aussi</h2>
  <div class="related-block-photos">
    <?php
      $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 2,
        'post__not_in' => array(get_the_ID()),
        'categorie' => get_the_terms(get_the_ID(), 'categorie')[0]->slug,
      );
      
      $query = new WP_Query($args);
      
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
          get_template_part( 'templates_part/photo-block' );
        endwhile;
      endif;
      
      wp_reset_postdata();
    ?>
  </div>
</div>

 <!-- Bouton "Toutes les photos" -->
 <div class="button-all-photo">
 <?php
    $current_category = get_the_terms(get_the_ID(), 'categorie')[0];
    $all_photos_link = get_term_link($current_category);
  ?>
  <a href="<?php echo $all_photos_link; ?>" class="all-photos-button">Toutes les photos</a>
    </div>

</div>


<?php get_template_part('templates_part/modal-contact'); ?>

<?php get_footer(); ?>