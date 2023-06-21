


<?php get_header(); ?>

<div class="photo-info-container">
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
    <a class="fullscreen-link" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-lightbox="photo">Plein écran</a>
  </div>
  <div class="photo-info-nav">
    <div class="photo-info-interest">
      <p>Cette photo vous intéresse ?</p>
    </div>
    <button id="contactBtn" data-photo-ref="<?php the_field('reference'); ?>">Contact</button>

    <div class="photo-info-nav-block">

    <div class="photo-info-nav-prev">   
      <!-- Miniature précédente -->
      <div class="thumbnail-previous">
      <?php $prev_post = get_previous_post(); ?>
      <?php if ($prev_post) : ?>
        <img class="nav-thumbnail" src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id($prev_post->ID), 'thumbnail' ); ?>" alt="<?php echo $prev_post->post_title; ?>">
      <?php endif; ?>
      </div>
      <?php previous_post_link('%link', '<img src="/wp-content/themes/NathalieMota/images/arrow_left.svg" alt="Précédent">', FALSE, '', 'format'); ?>
    </div>

    <div class="photo-info-nav-next">    
      <!-- Miniature suivante -->
      <div class="thumbnail-next">
      <?php $next_post = get_next_post(); ?>
      <?php if ($next_post) : ?>
        <img class="nav-thumbnail" src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id($next_post->ID), 'thumbnail' ); ?>" alt="<?php echo $next_post->post_title; ?>">
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
        'category__in' => wp_get_post_categories(get_the_ID()),
      );
    
      $query = new WP_Query($args);
    
      while ($query->have_posts()) {
        $query->the_post();
        ?>
        <a href="<?php the_permalink(); ?>">
          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        </a>
        <?php
      }
    ?>
  </div>
</div>

<?php get_template_part('templates_part/modal-contact'); ?>

<?php get_footer(); ?>