<?php

/**
* Registering custom post
*
*@package AwesomeRecipePlugin
*/



function awesome_recipe_init(){
	$labels = array(
		'name'               => __( 'Recipes', 'recipes', 'awesome_recipe' ),
		'singular_name'      => __( 'Recipe', 'recipe', 'awesome_recipe' ),
		'menu_name'          => __( 'Recipes', 'admin menu', 'awesome_recipe' ),
		'name_admin_bar'     => __( 'Recipe', 'add new on admin bar', 'awesome_recipe' ),
		'add_new'            => __( 'Add New', 'Recipe', 'awesome_recipe' ),
		'add_new_item'       => __( 'Add New Recipe', 'awesome_recipe' ),
		'new_item'           => __( 'New Recipe', 'awesome_recipe' ),
		'edit_item'          => __( 'Edit Recipe', 'awesome_recipe' ),
		'view_item'          => __( 'View Recipe', 'awesome_recipe' ),
		'all_items'          => __( 'All Recipes', 'awesome_recipe' ),
		'search_items'       => __( 'Search Recipes', 'awesome_recipe' ),
		'parent_item_colon'  => __( 'Parent Recipes:', 'awesome_recipe' ),
		'not_found'          => __( 'No Recipe found.', 'awesome_recipe' ),
		'not_found_in_trash' => __( 'No Recipe found in Trash.', 'awesome_recipe' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Publish your awesome recipe like a pro.', 'awesome_recipe' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recipe' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 110, //seting dashboard menu position
		'taxonomies'		 => array( 'category', 'post_tag' ),
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'recipe', $args );
	


	// clear the permalinks to remove our post type's rules from the database
   flush_rewrite_rules();
}