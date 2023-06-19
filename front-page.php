<?php
/**
 * Template Name: Page d'accueil
 */

get_header();
?>

<section class="hero">
  <?php $hero_image = get_field('photos'); ?>
  <?php if ($hero_image) : ?>
    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
  <?php endif; ?>
</section>

<section class="photo-catalog">
  <div class="filters">
    <label for="category-filter">Catégorie</label>
    <select name="category-filter" id="category-filter">
      <option value="">Toutes les catégories</option>
      <?php
        $categories = get_terms( array(
          'taxonomy' => 'categorie',
          'hide_empty' => true,
        ) );

        foreach ( $categories as $category ) :
      ?>
        <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="format-filter">Format</label>
    <select name="format-filter" id="format-filter">
      <option value="">Tous les formats</option>
      <option value="paysage">Paysage</option>
      <option value="portrait">Portrait</option>
    </select>

    <label for="date-sort">Trier par date</label>
    <select name="date-sort" id="date-sort">
      <option value="DESC">Plus récentes</option>
      <option value="ASC">Plus anciennes</option>
    </select>
  </div>

  <div class="photo-grid">
  <?php
    $args = array(
      'post_type' => 'photos',
      'posts_per_page' => 12,
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();
        get_template_part( 'templates_part/photo-block' );
      endwhile;
    endif;
    wp_reset_postdata();
  ?>
</div>

<button id="load-more">Charger plus</button>
</section>

<?php get_footer(); ?>