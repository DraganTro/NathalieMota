<li class="photo">
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'photos' ); ?>
    <div class="photo-overlay">
      <a href="<?php echo wp_get_attachment_image_url( get_the_ID(), 'full' ); ?>" class="photo-fullscreen" title="<?php the_title(); ?>"><i class="fas fa-expand"></i></a>
      <a href="<?php the_permalink(); ?>" class="photo-details" title="<?php the_title(); ?>"><i class="fas fa-eye"></i></a>
    </div>
  </a>
</li>