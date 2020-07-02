<?php
/**
 * @package 	WordPress
 * @subpackage 	Good Food Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function good_food_child_enqueue_styles() {
    wp_enqueue_style('good-food-child-style', get_stylesheet_uri(), array(), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'good_food_child_enqueue_styles', 11);
?>