<?php
function design55_customize_register( $wp_customize ) {
    $wp_customize->add_section('design55_hero_section', array(
        'title' => __('Hero Section','design55'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('hero_title', array('default' => 'Unforgettable Interiors for Modern Living'));
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title','design55'),
        'section' => 'design55_hero_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('hero_subtitle', array('default' => 'Live Beautifully, Love Your Space'));
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle','design55'),
        'section' => 'design55_hero_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('accent_pink', array('default' => '#ff66c4'));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_pink', array(
        'label'    => __( 'Accent Pink', 'design55' ),
        'section'  => 'colors',
        'settings' => 'accent_pink',
    )));
}
add_action( 'customize_register', 'design55_customize_register' );
?>