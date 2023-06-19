


<?php get_header(); ?>

<div class="photo-info-container">
  <div class="photo-info-left">
    <h1><?php the_title(); ?></h1>
    <p>Référence : <?php the_field('reference'); ?></p>
    <p>Catégorie : <?php echo get_the_term_list( get_the_ID(), 'categorie', '', ', ' ); ?></p>
    <p>Format : <?php echo get_the_term_list( get_the_ID(), 'format', '', ', ' ); ?></p>
    <p>Année : <?php the_field('annee'); ?></p>
    <button id="contactBtn" data-photo-ref="<?php the_field('reference'); ?>">Contact</button>
  </div>
  <div class="photo-info-right">
    <?php the_post_thumbnail('full'); ?>
    <a class="fullscreen-link" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-lightbox="photo">Plein écran</a>
  </div>
  <div class="photo-info-nav">
    <div class="photo-info-nav-prev">
      <?php previous_post_link('%link', '<span class="nav-arrow">&lt;</span> Précédent', TRUE, '', 'format'); ?>
    </div>
    <div class="photo-info-nav-next">
      <?php next_post_link('%link', 'Suivant <span class="nav-arrow">&gt;</span>', TRUE, '', 'format'); ?>
    </div>
  </div>
</div>

<?php get_template_part('templates_part/modal-contact'); ?>

<?php get_footer(); ?>