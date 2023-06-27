<?php
/**
 * Template Name: Page d'accueil
 */

get_header();
?>

<section class="hero">
    <div class="hero-photo">
        <?php
        $featured_image_url = get_random_catalog_image_url();

        if ( $featured_image_url ) {
            ?>
            <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Featured Image">
            <?php
        }
        ?>
    </div>
    
</section>

<section class="photo-catalog">
  <div class="filters">
    <label for="category-filter"></label>
    <select name="category-filter" id="category-filter">
      <option value="">Catégories</option>
      <?php
        $categories = get_terms(array(
          'taxonomy' => 'categorie',
          'hide_empty' => true,
        ));

        foreach ($categories as $category) :
      ?>
      <option value="<?php echo $category->slug; ?>" <?php selected($category->slug, isset($_GET['category']) ? $_GET['category'] : ''); ?>>
        <?php echo $category->name; ?>
      </option>
      <?php endforeach; ?>
    </select>

    <label for="format-select"></label>
    <select name="format-select" id="format-select">
      <option value="">Formats</option>
      <?php
        $formats = get_terms(array(
          'taxonomy' => 'format',
          'hide_empty' => true,
        ));
        foreach ($formats as $format) :
      ?>
      <option value="<?php echo $format->slug; ?>" <?php selected($format->slug, isset($_GET['format']) ? $_GET['format'] : ''); ?>>
        <?php echo $format->name; ?>
      </option>
      <?php endforeach; ?>
    </select>

    <label for="date-select"></label>
    <select name="date-select" id="date-select">
      <option value="">Trier par</option>
      <option value="DESC" <?php selected('DESC', isset($_GET['date']) ? $_GET['date'] : 'DESC'); ?>>Plus récentes en premier</option>
      <option value="ASC" <?php selected('ASC', isset($_GET['date']) ? $_GET['date'] : ''); ?>>Plus anciennes en premier</option>
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