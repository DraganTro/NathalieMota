<?php

function nathalie_mota_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'nathalie_mota_scripts' );

function register_my_menus() {
    register_nav_menus(
      array(
        'primary-menu' => __( 'Primary Menu' ),
      )
    );
  }
  add_action( 'init', 'register_my_menus' );





?>

