<li class="photo">
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'thumbnail' ); ?>
  </a>
  <h3><?php the_title(); ?></h3>
  <p>Type : <?php the_field( 'type' ); ?></p>
  <p>Référence : <?php the_field( 'reference' ); ?></p>
  <p>Année : <?php the_field( 'annee' ); ?></p>
  <p>Format : <?php the_field( 'format' ); ?></p>
</li>