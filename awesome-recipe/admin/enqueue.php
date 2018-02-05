<?php

/**
* Enque styles
*
*@package AwesomeRecipePlugin
*/




//Enqueue style for admin panel area for recipe post type.


function add_admin_stylesheet() 
{
    wp_enqueue_style( 'awesome_recipe_CSS', plugins_url( '/assets/styles/admin-styles.css', AWESOME_RECIPE_PLUGIN_URL ) );
}

add_action('admin_print_styles', 'add_admin_stylesheet');


function add_admin_recipe_settings_colorpicker() 
{
    wp_enqueue_script( 'awesome_recipe_colorpicker', plugins_url( '/assets/scripts/jscolor.js', AWESOME_RECIPE_PLUGIN_URL ) );
}

add_action('admin_enqueue_scripts', 'add_admin_recipe_settings_colorpicker');



// Enqueue style for admin panel. To make input UI more proffessional.


function awesome_recipe_enqueue(){
	global $typenow; // This variable is set by WordPress. Value is set to be current post type that user is in.

	// Below code is for keep equeue styles only in the admin panel not front end or other post type, or settings or any admin menu item
	if( $typenow != "recipe" ){ // {recipe} {post_type}
		return;
	}

	wp_register_style( 
		'awesome_recipe_bootstrap',
		plugins_url( '/assets/styles/bootstrap.css', AWESOME_RECIPE_PLUGIN_URL )
	);
	wp_enqueue_style( 'awesome_recipe_bootstrap' );



// Script for dynamic fields
 wp_enqueue_script( 'my-script', plugins_url ('/assets/scripts/dynamic-fields.js', AWESOME_RECIPE_PLUGIN_URL));
 // Style for dynamic fields
  wp_enqueue_style( 'custom_wp_admin_css', plugins_url('/assets/styles/dynamic-fields.css', AWESOME_RECIPE_PLUGIN_URL) );
  // Including Font Awesome
   wp_enqueue_style('fontawesome', 'http:////netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css', '', '4.5.0', 'all');

}





// Enqueueing styles for frontend recipe single post

function add_frontend_stylesheet() {

	if( is_singular( 'recipe' ) ){
	    wp_enqueue_style( 'awesome_recipe_CSS', plugins_url( '/assets/styles/recipe-single-post.css', AWESOME_RECIPE_PLUGIN_URL ) );
	    
	    // Including Font Awesome
	     wp_enqueue_style( 'awesome_recipe_CSS', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	}

}


add_action('wp_print_styles', 'add_frontend_stylesheet');


// Enqueueing styles for frontend recipe shortcode page
function add_frontend_stylesheet_shortcode() {

    wp_enqueue_style( 'awesome_recipe_shortcode_CSS', plugins_url( '/assets/styles/recipe-shortcode.css', AWESOME_RECIPE_PLUGIN_URL ) );

}



add_action('wp_print_styles', 'add_frontend_stylesheet_shortcode');


// Enqueueing styles for frontend rating
function awesome_recipe_frontend_enque_scripts(){

	wp_register_style( 

		'awesome_recipe_rateit',
		plugins_url( '/assets/rateit/rateit.css', AWESOME_RECIPE_PLUGIN_URL )

	 );

	wp_enqueue_style( 'awesome_recipe_rateit' );


	wp_register_script(

		'awesome_recipe_rateit',
		plugins_url( '/assets/rateit/jquery.rateit.min.js', AWESOME_RECIPE_PLUGIN_URL ),
		array( 'jquery' ),
		'1.1.0',
		true

	);


	wp_register_script(

		'awesome_recipe_main',
		plugins_url( '/assets/scripts/main.js', AWESOME_RECIPE_PLUGIN_URL ), // we have to edit this
		array( 'jquery' ),
		'1.1.0',
		true

	);

	// for ratings
	// wp_localize_script() provides translated strings to javaScripts
	wp_localize_script( 'awesome_recipe_main', 'awesome_recipe_obj', array(
		'ajax_url'                  =>  admin_url( 'admin-ajax.php' ),
		'home_url'                  =>  home_url( '/' )
	));

	wp_enqueue_script( 'awesome_recipe_rateit' );
	wp_enqueue_style( 'awesome_recipe_rateit' );
	wp_enqueue_script( 'awesome_recipe_main' );

}