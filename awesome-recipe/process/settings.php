<?php

/**
*
* Settings page ( Admin area )
* 
*@package AwesomeRecipePlugin
*/



function awesome_recipe_settings_panel(){

	global  $wpdb;

	// Getting row data

	$styles = $wpdb->get_row(
						"SELECT * FROM `". $wpdb->prefix ."awesome_recipe_styles`
						ORDER BY id DESC LIMIT 1"
						); 


	// Storing data into an array

	foreach ($styles as $key => $style) {

	}

?>

<div class="wrap">

<!-- Display Success message on save-->
<div id="success"></div>


<!-- Setting UI for Action link page -->


<h3>Recipe Settings</h3>
	<hr>
	<h4>How to display your recipe posts to any page ?</h4>
	<h5>Simple place this shortcode [recipe] to any page to display your recipe posts.</h5>
<br>
	<h4>Customize single recipe post</h4>
	<hr>
<form method="post" action="">

	<label>Icon Color</label><br>
	<input class="jscolor"  type="text" name="icon_color" value='<?php echo  $styles->icon_color; ?>'><em> e.g. #d80027</em><br><br>

	<label>Header Background Color</label><br>
	<input class="jscolor" type="text" name="header_background" value='<?php echo  $styles->header_background; ?>'><br><br>

	<label>Header Font Size</label><br>
	<input class="awesome-recipe-settings" type="number" name="header_font_size" value='<?php echo  $styles->header_font_size; ?>'><em> px</em><br><br>

	<label>Header Font Style</label><br>
	<input class="awesome-recipe-settings" type="text" name="header_font_style" value='<?php echo  $styles->header_font_style; ?>'><br><br>

	<label>Header Font Color</label><br>
	<input class="jscolor" type="text" name="header_font_color" value='<?php echo  $styles->header_font_color; ?>'><br><br>

	<label>List font size</label><br>
	<input class="awesome-recipe-settings" type="number" name="list_font_size" value='<?php echo  $styles->list_font_size; ?>'><em> px</em><br><br>


	<h4>Customize your [recipe] page</h4>
	<hr>
	<label>Number Of Posts To Display</label><br>
	<input class="awesome-recipe-settings" type="number" name="recipe_card_number_of_posts" value='<?php echo  $styles->recipe_card_number_of_posts; ?>'><br><br>

	<label>Recipe Card Background</label><br>
	<input class="jscolor" type="text" name="recipe_card_background_color" value='<?php echo  $styles->recipe_card_background_color; ?>'><br><br>

	<label>Recipe Card Width</label><br>
	<input class="awesome-recipe-settings" type="number" name="recipe_card_width" value='<?php echo  $styles->recipe_card_width; ?>'><em> %</em><br><br>

	<label>Recipe Card Height</label><br>
	<input class="awesome-recipe-settings" type="number" name="recipe_card_height" value='<?php echo  $styles->recipe_card_height; ?>'><em> px</em><br><br>

	<label>Recipe Card Title Color</label><br>
	<input class="jscolor" type="text" name="recipe_card_title_color" value='<?php echo  $styles->recipe_card_title_color; ?>'><br><br>

	<label>Recipe Card Title Font Size</label><br>
	<input class="awesome-recipe-settings" type="number" name="recipe_card_title_font_size" value='<?php echo  $styles->recipe_card_title_font_size; ?>'><em> px</em><br><br>

 <label>Recipe Card Title Font Style</label><br>
    <select name="recipe_card_title_font_style">
		
        <option value="Select">Select</option>
       

        <option value="uppercase" 

          <?php 
          if ($styles->recipe_card_title_font_style) { // checks if array key exists
                if ($styles->recipe_card_title_font_style =="uppercase"){ // check if it matches with array index data or not
                echo "SELECTED";  
                }
            }
          ?>

        >UPPERCASE</option>


        <option value="lowercase" 

          <?php  
          if ($styles->recipe_card_title_font_style) {
                if ( $styles->recipe_card_title_font_style =="lowercase"){
                    echo "SELECTED";  
                }
            }
         ?>

         >lowercase</option>

         <option value="capitalize"

         <?php 
            if ($styles->recipe_card_title_font_style) {
                if ($styles->recipe_card_title_font_style =="capitalize"){
                    echo "SELECTED";  
                }
            }
         ?>

         >Capitalize</option>

    </select><br><br>

	<label>Recipe Card Border Color</label><br>
	<input class="jscolor" type="text" name="recipe_card_border_color" value='<?php echo  $styles->recipe_card_border_color; ?>'><br><br>

	<label>Recipe Card "Read More" link color</label><br>
	<input class="jscolor" type="text" name="read_more_link_color" value='<?php echo  $styles->read_more_link_color; ?>'><br><br>

	<label>Recipe Card text color</label><br>
	<input class="jscolor" type="text" name="recipe_card_excerpt_text_color" value='<?php echo  $styles->recipe_card_excerpt_text_color; ?>'><br><br>

	<label>Recipe Card Pagination Background color</label><br>
	<input class="jscolor" type="text" name="recipe_card_excerpt_text_color" value='<?php echo  $styles->recipe_card_excerpt_text_color; ?>'><br><br>


	<input type="submit" class="button button-primary button-large" name="custom-settings" value="Save">
</form>

<!-- LOAD DEFAULT SETTINGS-->
<form name="load-default-settings"  method="post" action="">
    <input style="float:right;" class="button button-primary button-large" type="submit" name="default" value="Load Default Settings">
</form>
<!-- END LOAD DEFAULT SETTINGS-->





</div>






<?php

	// Save data to DB

	if(isset($_POST['custom-settings'])){
	global $wpdb;

		$updateDB = " UPDATE ". $wpdb->prefix ."awesome_recipe_styles  

		SET
			`header_background` = '" . $_POST['header_background'] . "' ,
			`header_font_size` = '" . $_POST['header_font_size'] . "',
			`header_font_style` = '" . $_POST['header_font_style'] . "',
			`header_font_color` = '" . $_POST['header_font_color'] . "',
			`icon_color` = '" . $_POST['icon_color'] . "',
			`list_font_size` = '" . $_POST['list_font_size'] . " ',
			`recipe_card_title_color` = '" . $_POST['recipe_card_title_color'] . "',
			`recipe_card_title_font_size` = '" . $_POST['recipe_card_title_font_size'] . "',
			`recipe_card_title_font_style` = '" . $_POST['recipe_card_title_font_style'] . "',
			`recipe_card_border_color` = '" . $_POST['recipe_card_border_color'] . "',
			`recipe_card_number_of_posts` = '" . $_POST['recipe_card_number_of_posts'] . "',
			`recipe_card_width` = '" . $_POST['recipe_card_width'] . "',
			`recipe_card_height` = '" . $_POST['recipe_card_height'] . "',
			`read_more_link_color` = '" . $_POST['read_more_link_color'] . "',
			`pagination_background_color` = '" . $_POST['pagination_background_color'] . "',
			`recipe_card_background_color` = '" . $_POST['recipe_card_background_color'] . "',
			`recipe_card_excerpt_text_color` = '" . $_POST['recipe_card_excerpt_text_color'] . "'
			
		
		WHERE `ID`=1

		";

		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

		dbDelta( $updateDB );

?>

<script>
document.getElementById("success").innerHTML = '<div id="message" class="updated notice notice-success is-dismissible"><p>Your settings are saved successfully.</p><a href="#"></div>';
 location.reload();
</script>

<?php

	} // END IF

?>



<?php
	
	// Store default settings

	global $wpdb;
	if(isset($_POST['default'])) {


		$updateDB = " UPDATE ". $wpdb->prefix ."awesome_recipe_styles  

			SET
				`header_background` = 'D80027' ,
				`header_font_size` = '18',
				`header_font_style` = 'uppercase',
				`header_font_color` = 'FFFFFF',
				`icon_color` = 'D80027',
				`list_font_size` = '14',
				`recipe_card_title_color` = 'D80027',
				`recipe_card_title_font_size` = '18',
				`recipe_card_title_font_style` = 'uppercase',
				`recipe_card_border_color` = 'c7c7c7',
				`recipe_card_number_of_posts` = '6',
				`recipe_card_width` = '31',
				`recipe_card_height` = '490',
				`read_more_link_color` = 'D80027',
				`pagination_background_color` = 'D80027',
				`recipe_card_background_color` = 'FFFFFF',
				`recipe_card_excerpt_text_color` = '8A8A8A'
				
			
			WHERE `ID`=1

			";

		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

		dbDelta( $updateDB );

?>
<!-- Reload the screen and display success message -->
<script>
document.getElementById("success").innerHTML = '<div id="message" class="updated notice notice-success is-dismissible"><p>Your settings are saved successfully.</p><a href="#"></div>';
location.reload();
</script>

<?php

	}// END IF

} // END Function

