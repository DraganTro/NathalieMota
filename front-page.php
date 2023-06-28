<?php
/**
 * Template Name: Page d'accueil
 */

get_header();
?>
<!-- Hero avec photo aléatoire -->
<section class="hero">
  <div class="hero-photo">
    <?php
    $featured_image_url = get_random_catalog_image_url();

    if ( $featured_image_url ) {
      $image_id = attachment_url_to_postid( $featured_image_url );
      $metadata = wp_get_attachment_metadata( $image_id );

      if ( $metadata['height'] <= $metadata['width'] ) {
        $image_src = wp_get_attachment_image_src( $image_id, 'large' );
        ?>
        <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="Featured Image">
        <?php
      } else {
        // Si l'image est en format portrait, on récupère une autre image aléatoire
        $featured_image_url = get_random_catalog_image_url();
        $image_id = attachment_url_to_postid( $featured_image_url );
        $image_src = wp_get_attachment_image_src( $image_id, 'large' );
        ?>
        <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="Featured Image">
        <?php
      }
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