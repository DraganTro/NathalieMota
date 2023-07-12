<!DOCTYPE html>
<html lang="<?php echo get_bloginfo('language'); ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Photographe event">
    <title><?= get_bloginfo('name') ?> - <?= wp_title(' | ') ?></title>
    <script src="https://kit.fontawesome.com/e480a2e691.js" crossorigin="anonymous"></script>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
  <div class="container-header">
    <div class="row-header">
      <div class="col-md-3">
        <a href="<?php echo home_url(); ?>"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo"></a>
  </div>
  <div class="col-md-9">
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu' ) ); ?>
    <input id="toggle" type="checkbox"></input>

    <label for="toggle" class="hamburger">
      <div class="top-bun"></div>
      <div class="meat"></div>
      <div class="bottom-bun"></div>
    </label>

          <div class="nav">
            <div class="nav-wrapper">
              <nav>
                <div class="mobile-menu">
                  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mobile-menu-list' ) ); ?>
                </div>
              </nav>
            </div>
          </div>
        </div>
    </div>
  </div>
</header>





