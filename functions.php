<?php

function nathalie_mota_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  // condition pour charger le fichier style-single.css uniquement sur la page single.php
  if ( is_single() ) {
    wp_enqueue_style( 'style-single', get_template_directory_uri() . '/style-single.css' );
  }

  wp_enqueue_script( 'jquery' ); 
  wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true ); 
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_scripts' );

// Ajout du menu
function register_my_menus() {
  register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Menu' ),
      'mobile-menu' => __( 'Mobile Menu')
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Ajout de la modale au menu
function add_contact_modal_to_menu( $items, $args ) {
  $contact_modal = '<li><a id="contactBtn" class="open-contact-modal menu-link-contact">Contact</a></li>';
  if ( $args->theme_location == 'primary' ) {
    $items = $items . $contact_modal;
  }
  return $items;
}
add_filter( 'wp_nav_menu_items', 'add_contact_modal_to_menu', 10, 2 );

// Chargement des polices google font
function wp_enqueue_custom_fonts() {
  wp_enqueue_style( 'space-mono', get_template_directory_uri() . '/fonts/SpaceMono-Regular.ttf' );
  wp_enqueue_style( 'poppins', get_template_directory_uri() . '/fonts/Poppins-Regular.ttf' );
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_custom_fonts' );

// Ajout de la fonctionnalité "Image à la une"
add_theme_support( 'post-thumbnails' );

// Fonction charger plus
function load_more_photos() {
  $offset = $_POST['offset'];
  $args = array(
    'post_type' => 'photos',
    'posts_per_page' => 12,
    'offset' => $offset,
  );
  $query = new WP_Query( $args );
  if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
      get_template_part( 'templates_part/photo-block' );
    endwhile;
  endif;
  wp_reset_postdata();
  die();
}
add_action( 'wp_ajax_load_more_photos', 'load_more_photos' );
add_action( 'wp_ajax_nopriv_load_more_photos', 'load_more_photos' );



function my_theme_enqueue_scripts() {
  wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true );
  wp_localize_script( 'my-script', 'my_script_vars', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
  ) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );

// Ajout d'un filtre pour utiliser le fichier single-photo.php
add_filter('template_include', 'custom_single_template');

function custom_single_template($template) {
    if (is_singular('photos')) {
        $new_template = locate_template(array('single-photo.php'));
        if ('' != $new_template) {
            return $new_template;
        }
    }
    return $template;
}

// Fonction image aléatoire du Hero
function get_random_catalog_image_url() {
  $args = array(
      'post_type' => 'photos',
      'posts_per_page' => 1,
      'orderby' => 'rand',
  );
  
  $query = new WP_Query( $args );
  
  if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
          $query->the_post();
          $featured_image_url = get_the_post_thumbnail_url();
      }
      wp_reset_postdata();
      
      return $featured_image_url;
  } else {
      return false;
  }
}

// Fonction pour récupérer les résultats filtrés et triés de l'API WordPress avec Ajax
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos() {
  $category = $_POST['category'];
  $format = $_POST['format'];
  $sortOrder = $_POST['sortOrder'];

  $args = array(
    'post_type' => 'photos',
    'posts_per_page' => 12,
    'tax_query' => array(),
    'meta_query' => array(),
    'orderby' => 'date',
    'order' => $sortOrder
  );

  if ($category) {
    $args['tax_query'][] = array(
      'taxonomy' => 'categorie',
      'field' => 'slug',
      'terms' => $category
    );
  }

  if ($format) {
    $args['tax_query'][] = array(
      'taxonomy' => 'format',
      'field' => 'slug',
      'terms' => $format
    );
  }

  $query = new WP_Query($args);

  ob_start();

  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      get_template_part('templates_part/photo-block');
    endwhile;
  endif;

  wp_reset_postdata();

  echo ob_get_clean();
  wp_die();
}



function create_photo_post_type() {
  register_post_type( 'photos',  
    array(
      'labels' => array(
        'name'               => 'Photos',
        'singular_name'      => 'Photo',
        // ...
      ),  
      'has_archive' => 'photo',
      'public'   => true,
    )  
  );
}
add_action( 'init', 'create_photo_post_type' );



// Ajout lightbox.js
function enqueue_lightbox_script() {
  wp_enqueue_script( 'lightbox-script', get_template_directory_uri() . '/js/lightbox.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_lightbox_script' );


?>

