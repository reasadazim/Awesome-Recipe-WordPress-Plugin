<?php

/**
*@package AwesomeRecipePlugin
*/

/*
Plugin Name:  Awesome Recipe Plugin
Plugin URI:   http://awesomerecipe.owlsyard.com/
Description:  Publish your recipe like a professional.
Version:      1.0
Author:       Reasad Azim
Author URI:   http://owlsyard.com/about
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  awesome-recipe
Domain Path:  /languages
*/

/*
Awesome Recipe Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Awesome Recipe Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Awesome Recipe Plugin. If not, see {URI to Plugin License}.
*/


// Secure plugin 

if ( !function_exists('add_action') ){
	die( 'Hi there! I am just a plugin. Not much I can do when called directly!' );
}


// Define plugin URL 

define( 'AWESOME_RECIPE_PLUGIN_URL', __FILE__ );



// Includes

include ( 'includes/activate.php' );
include ( 'includes/deactivate.php' );
include ( 'includes/init.php' );
include ( 'admin/init.php' );
include ( 'process/save-post.php' );
include ( 'process/filter-content.php' );; 
include ( 'process/rate-recipe.php' ); 
include ( 'process/shortcode.php' ); 
include ( 'process/settings.php' );


// Activation

register_activation_hook( __FILE__, 'awesome_recipe_activation' );



// Creating a custom post type for recipe

add_action( 'init', 'awesome_recipe_init' );



// Save post

add_action( 'save_post_recipe', 'awesome_recipe_save_post_admin', 10, 3 );




// Creating a custom Meta Box

add_action( 'init', 'awesome_recipe_admin_init' );




// Display custom meta box fields to custom post type frontend

add_filter( 'the_content', 'awesome_recipe_content_filter' );




// Enqueue script and style for frontend

add_action( 'wp_enqueue_scripts', 'awesome_recipe_frontend_enque_scripts', 100 );




// Ajax for Recipe ratings

add_action( 'wp_ajax_awesome_recipe_rating', 'awesome_recipe_rating' );
add_action( 'wp_ajax_nopriv_awesome_recipe_rating', 'awesome_recipe_rating' ); // {nopriv} So that not logged in users can also rate a recipe




// Change placeholder for post title {TinyMCE}

function change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'recipe' == $screen->post_type ){
        $title = 'Name of the recipe';
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_default_title' );



// Display post on taxonomy search search

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() || is_author() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'recipe'
        ));
       return $query;
    }


}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );



// Remoce default TinyMCE editor from recipe post editor

add_action('init', 'init_remove_support',100);
function init_remove_support(){
    $post_type = 'recipe';
    remove_post_type_support( $post_type, 'editor');
}


// Add settings page

function awesome_recipe_settings(){

  add_submenu_page( 
    'edit.php?post_type=recipe', 
    'Settings', 
    'Recipe Settings', 
    'manage_options', 
    'recipe_settings', 
    'awesome_recipe_settings_panel' 
  );

}

add_action( 'admin_menu', 'awesome_recipe_settings' );



// Shortcodes

add_shortcode( 'recipe', 'awesome_recipe_creator_shortcode' );



// Plugin Action Link

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'edit.php?post_type=recipe&page=recipe_settings' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}



// Deactivation

register_deactivation_hook( __FILE__, 'awesome_recipe_deactivation' );


