<?php

/**
* For storing rating data in DB
*
*@package AwesomeRecipePlugin
*/


function awesome_recipe_rating(){
	
	global $wpdb;

	$output = array( 'status' => 1 );
	$post_id = absint( $_POST['rid'] );
	$rating = round( $_POST['rating'], 1 );
	$user_IP = $_SERVER['REMOTE_ADDR'];


// Get rating data from DB
$rating_count = $wpdb->get_var(
	"SELECT COUNT(*) FROM `" . $wpdb->prefix . "awesome_recipe_ratings`
	WHERE recipe_id='" . $post_id . "' AND user_ip='" . $user_IP . "'"
);


if( $rating_count > 0 ){
		wp_send_json( $output );
	}

// Store rating data into DB
	$wpdb->insert(
		$wpdb->prefix.'awesome_recipe_ratings',
		array(
			'recipe_id' => $post_id,
			'rating' => $rating,
			'user_ip' => $user_IP
		),
		array( '%d', '%f', '%s' )
	);

// Displaying average rating 
$awesome_recipe_input_data = get_post_meta( $post_id, 'awesome_recipe_input_data', true );
$awesome_recipe_input_data['rating_count']++;

$awesome_recipe_input_data['rating']  =   round($wpdb->get_var(
	"SELECT AVG(`rating`) FROM `". $wpdb->prefix ."awesome_recipe_ratings`
	WHERE recipe_id='". $post_id ."'"
), 1 );

// update post meta
update_post_meta( $post_id, 'awesome_recipe_input_data', $awesome_recipe_input_data );

// Close AJAX
	$output['status'] = 2;
	wp_send_json( $output );

}
