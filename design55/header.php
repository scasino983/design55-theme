<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="branding">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <span class="site-title"><?php bloginfo('name'); ?></span>
      <?php endif; ?>
      <span class="site-tagline"><?php bloginfo('description'); ?></span>
    </div>
    <nav class="main-nav">
      <?php wp_nav_menu( array('theme_location' => 'main-menu') ); ?>
    </nav>
  </header>
