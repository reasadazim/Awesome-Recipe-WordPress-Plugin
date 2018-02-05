<?php

/**
* Triggers when activate the plugin.
*
*@package AwesomeRecipePlugin
*/

function awesome_recipe_activation(){

	// Check WordPress version and display a message if current version is not compatible.
	if ( version_compare( get_bloginfo( 'version' ), 4.8, '<') ){
		wp_die( 'You must update WordPress to use this plugin.' );
	}


 flush_rewrite_rules();


    // creating database tables for rating.
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $createSQL = "

    CREATE TABLE IF NOT EXISTS `". $wpdb->prefix ."awesome_recipe_ratings` (
	`ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`recipe_id` BIGINT(20) UNSIGNED NOT NULL,
	`rating` FLOAT(3,2) UNSIGNED NOT NULL,
	`user_ip` VARCHAR(32) NOT NULL,
	PRIMARY KEY (`ID`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 $charset_collate; 

	";

	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

	dbDelta( $createSQL ); 


	// Create DB table for storing recipe settings
	$createSQL = "

	CREATE TABLE IF NOT EXISTS `". $wpdb->prefix ."awesome_recipe_styles` (

		`ID` BIGINT(20) NOT NULL,
		`header_background` VARCHAR(50) NULL DEFAULT NULL,
		`header_font_size` INT(2) NULL DEFAULT NULL,
		`header_font_style` VARCHAR(50) NULL DEFAULT NULL,
		`header_font_color` VARCHAR(50) NULL DEFAULT NULL,
		`icon_color` VARCHAR(50) NULL DEFAULT NULL,
		`list_font_size` INT(2) NULL DEFAULT NULL,
		`recipe_card_title_color` VARCHAR(50) NULL DEFAULT NULL,
		`recipe_card_title_font_size` INT(2) NULL DEFAULT NULL,
		`recipe_card_title_font_style` VARCHAR(50) NULL DEFAULT NULL,
		`recipe_card_number_of_posts` VARCHAR(50) NULL DEFAULT NULL,
		`recipe_card_border_color` VARCHAR(50) NULL DEFAULT NULL,
		`recipe_card_height` INT(3) NULL DEFAULT NULL,
		`recipe_card_width` INT(2) NULL DEFAULT NULL,
		`recipe_card_excerpt_text_color` VARCHAR(50) NULL DEFAULT NULL,
		`read_more_link_color` VARCHAR(50) NULL DEFAULT NULL,
		`pagination_background_color` VARCHAR(50) NULL DEFAULT NULL,
		`recipe_card_background_color` VARCHAR(50) NULL DEFAULT NULL,

		PRIMARY KEY (`ID`)
	)
	ENGINE=InnoDB AUTO_INCREMENT=1 $charset_collate;

	";

	/** WordPress Schema API */
	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

	dbDelta( $createSQL ); // Run the SQL query





	// Getting row data 

	$styles = $wpdb->get_row(
						"SELECT * FROM `". $wpdb->prefix ."awesome_recipe_styles`
						ORDER BY id DESC LIMIT 1"
						); 



	if (empty($styles)){ // checks if the table row has data or not

		// Insert default data
		$insert = "

		INSERT INTO `". $wpdb->prefix ."awesome_recipe_styles` (`ID`, `header_background`, `header_font_size`, `header_font_style`, `header_font_color`, `icon_color`, `list_font_size`, `recipe_card_title_color`, `recipe_card_title_font_size`, `recipe_card_title_font_style`, `recipe_card_number_of_posts`, `recipe_card_border_color`, `recipe_card_height`, `recipe_card_width`, `read_more_link_color`, `pagination_background_color`, `recipe_card_background_color`, `recipe_card_excerpt_text_color` ) VALUES
		(1, 'D80027', '18', 'uppercase', 'FFFFFF', 'D80027', 14, 'D80027', 18, 'uppercase', 6, 'c7c7c7', '490', '31', 'D80027', 'D80027', 'FFFFFF', '8A8A8A' );

		";

		/** WordPress Schema API */
		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

		dbDelta( $insert ); // Run the SQL query

		}else{

		
	}


}
