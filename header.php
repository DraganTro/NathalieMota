<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Ajoutez le contenu de l'en-tête ici -->
    <header>
    <div class="container-header">
        <div class="row-header">
            <div class="col-md-3">
                <a href="<?php echo home_url(); ?>"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo"></a>
            </div>
            <div class="col-md-9">
                <nav>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu' ) ); ?>
                </nav>
            </div>
        </div>
    </div>
</header>

