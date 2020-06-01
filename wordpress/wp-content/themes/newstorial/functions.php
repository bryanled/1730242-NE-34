<?php
/*This file is part of newstorial child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function newstorial_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'magazine-7-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700';
    wp_enqueue_style('newstorial-google-fonts', $fonts_url, array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'newstorial',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'newstorial_enqueue_child_styles' );



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newstorial_customize_register($wp_customize) {

     $wp_customize->get_setting( 'show_trending_news_section')->default = 0;    
     $wp_customize->get_setting( 'archive_layout')->default = 'archive-layout-full';   

}
add_action('customize_register', 'newstorial_customize_register', 9999);