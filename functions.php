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
  $offset = $_POST['offset']; // Récupère la valeur de 'offset' à partir de la requête POST
  $args = array(
    'post_type' => 'photos', // Type de publication à charger
    'posts_per_page' => 12, // Nombre de publications à afficher par page
    'offset' => $offset, // Index à partir duquel charger les photos supplémentaires
  );
  $query = new WP_Query( $args ); // Effectue une requête pour récupérer les photos selon les arguments spécifiés
  
  if ( $query->have_posts() ) : // Vérifie s'il y a des publications dans la requête
    while ( $query->have_posts() ) : $query->the_post(); // Boucle sur chaque publication
      get_template_part( 'templates_part/photo-block' ); // Affiche le modèle de bloc de photo
    endwhile;
  endif;
  
  wp_reset_postdata(); // Réinitialise les données de publication après la boucle
  
  die(); // Arrête l'exécution du script et renvoie la réponse
}

add_action( 'wp_ajax_load_more_photos', 'load_more_photos' ); // Ajoute l'action pour les requêtes AJAX des utilisateurs connectés
add_action( 'wp_ajax_nopriv_load_more_photos', 'load_more_photos' ); // Ajoute l'action pour les requêtes AJAX des utilisateurs non connectés


// Chargement du script
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
      'post_type' => 'photos', // Type de publication pour récupérer les photos
      'posts_per_page' => 1, // Nombre de publications à récupérer (une seule image aléatoire)
      'orderby' => 'rand', // Ordonner les résultats de manière aléatoire
  );
  
  $query = new WP_Query( $args ); // Effectue la requête pour récupérer une image aléatoire
  
  if ( $query->have_posts() ) { // Vérifie s'il y a des publications dans la requête
      while ( $query->have_posts() ) { // Boucle sur chaque publication (une seule dans ce cas)
          $query->the_post(); // Définit les données de la publication actuelle
          $featured_image_url = get_the_post_thumbnail_url(); // Récupère l'URL de l'image à la une de la publication
      }
      wp_reset_postdata(); // Réinitialise les données de publication après la boucle
      
      return $featured_image_url; // Renvoie l'URL de l'image à la une
  } else {
      return false; // Si aucune publication n'est trouvée, renvoie false
  }
}


// Fonction pour récupérer les résultats filtrés et triés de l'API WordPress avec Ajax
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos() {
  $category = $_POST['category']; // Récupère la valeur de 'category' à partir de la requête POST
  $format = $_POST['format']; // Récupère la valeur de 'format' à partir de la requête POST
  $sortOrder = $_POST['sortOrder']; // Récupère la valeur de 'sortOrder' à partir de la requête POST

  $args = array(
    'post_type' => 'photos', // Type de publication pour récupérer les photos
    'posts_per_page' => 12, // Nombre de publications à afficher par page
    'tax_query' => array(), // Requête de taxonomie (pour filtrer par catégorie et/ou format)
    'meta_query' => array(), // Requête de métadonnées (non utilisée dans ce cas)
    'orderby' => 'date', // Ordonner les résultats par date
    'order' => $sortOrder // Sens de tri (ascendant ou descendant)
  );

  if ($category) {
    $args['tax_query'][] = array(
      'taxonomy' => 'categorie', // Taxonomie (catégorie)
      'field' => 'slug', // Champ utilisé pour correspondre aux termes de taxonomie (slug)
      'terms' => $category // Terme de taxonomie à filtrer (slug de la catégorie)
    );
  }

  if ($format) {
    $args['tax_query'][] = array(
      'taxonomy' => 'format', // Taxonomie (format)
      'field' => 'slug', // Champ utilisé pour correspondre aux termes de taxonomie (slug)
      'terms' => $format // Terme de taxonomie à filtrer (slug du format)
    );
  }

  $query = new WP_Query($args); // Effectue la requête pour récupérer les photos filtrées et triées

  ob_start(); // Démarre la temporisation de sortie

  if ($query->have_posts()) : // Vérifie s'il y a des publications dans la requête
    while ($query->have_posts()) : $query->the_post(); // Boucle sur chaque publication
      get_template_part('templates_part/photo-block'); // Affiche le modèle de bloc de photo
    endwhile;
  endif;

  wp_reset_postdata(); // Réinitialise les données de publication après la boucle

  echo ob_get_clean(); // Récupère et affiche la sortie enregistrée dans la temporisation de sortie
  wp_die(); // Termine l'exécution du script
}



// Page d'archive
function create_photo_post_type() {
  register_post_type( 'photos',  
    array(
      'labels' => array(
        'name'               => 'Photos',
        'singular_name'      => 'Photo',
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


// Ajout du plugin Select2
function theme_enqueue_scripts() {

  wp_enqueue_style( 
    'select2',  
    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' 
  );

  wp_enqueue_script( 
    'select2',  
    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', 
    array('jquery'), 
    '4.1.0-rc.0', 
    true 
   );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );


?>

