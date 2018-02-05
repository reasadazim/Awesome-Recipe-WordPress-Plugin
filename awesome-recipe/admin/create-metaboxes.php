<?php

/**
* Initializing meta box
*
*@package AwesomeRecipePlugin
*/


function awesome_recipe_create_metaboxes(){
	add_meta_box( 
		'awesome_recipe_options', // ID 
		__('Recipe Information', 'awesome_recipe'),  // metabox header
		'awesome_recipe_options', // callback function
		'recipe', // post type
		'normal', // sets meta box below post editor, other available options: side (sidbar), advanced (above post editor)
		'high' // Priority
		 );
}




