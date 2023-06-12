<?php

function nathalie_mota_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_script( 'jquery' ); 
  wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true ); 
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_scripts' );

// Ajout du menu
function register_my_menus() {
  register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Ajout de la modale au menu
function add_contact_modal_to_menu( $items, $args ) {
  $contact_modal = '<li><a id="contactBtn">Contact</a></li>';
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


?>

