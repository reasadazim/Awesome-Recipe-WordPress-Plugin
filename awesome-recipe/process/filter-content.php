<?php

/**
* Display custom meta box fields to custom post type frontend
*
*@package AwesomeRecipePlugin
*/

function awesome_recipe_content_filter( $content ){

	// Check if it is Recipe post type
	if( !is_singular( 'recipe' ) ){
	return $content; 
	}

	global $post, $wpdb; // Getting access to all posts.

	$awesome_recipe_input_data = get_post_meta( $post->ID, 'awesome_recipe_input_data', true ); // getting custom metabox fields data

 	$awesome_recipe_dynamic_input_data =   get_post_meta($post->ID, 'awesome_recipe_dynamic_input_data', true); // Get dynamic fields (ingredients) data

 
 	$awesome_recipe_instruction = get_post_meta( $post->ID, 'awesome_recipe_instruction', true );
 	// Get TinyMCE data (instruction)

 	$awesome_recipe_dynamic_input_data_nutrition =   get_post_meta($post->ID, 'awesome_recipe_dynamic_input_data_nutrition', true); // Get dynamic fields (nutritions) data




// Getting row data
    $styles = $wpdb->get_row(
                        "SELECT * FROM `". $wpdb->prefix ."awesome_recipe_styles`
                        ORDER BY id DESC LIMIT 1"
                        ); 


    // Storing data into an array
    foreach ($styles as $key => $style) {

    }


?>



<!-- Open Graph -->
<meta property="og:title" content="<?php the_title(); ?>"/>
<meta property="og:description" content="<?php the_excerpt(); ?>"/>
<meta property="og:type" content="Recipe"/>
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:site_name" content="<?php bloginfo(); ?>"/>
<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>"/>

<!--  Recipe Image -->
<div class="recipe-image">


<?php

if ( has_post_thumbnail( $post->ID) ) {
   the_post_thumbnail( 'single-post-thumbnail' );
}
else {
    echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/picture.png">';
} 
?>

</div>
<!--  END Recipe Image -->

<!--  Change SVG ICON COLOR -->
<style>
    svg {width: 30px; height: 30px;}
    svg path{fill:#<?php echo  $styles->icon_color; ?>;}
    svg rect{fill:#<?php echo  $styles->icon_color; ?>;}
</style>
<!--  END Change SVG ICON COLOR -->

<!--  Short Details -->
<table style="width:100%; text-align: center;"  cellpadding="20">
  <tr>
    <td>
    	
	<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/serve.svg'; ?>"></div>
	<label>SERVING</label>
 	<div class="recipe-detailed-info"><?php echo $awesome_recipe_input_data['serving']; ?> Persons</div>  	
    </td>
    <td>
    	
	<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/course.svg'; ?>"></div>
	<label>COURSE</label>
	<div class="recipe-detailed-info"><?php echo $awesome_recipe_input_data['course']; ?></div>

    </td> 
    <td>
    	<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/cutlery.svg'; ?>"></div>
		<label>CUISINE</label>
		<div class="recipe-detailed-info"><?php echo $awesome_recipe_input_data['cuisine']; ?></div>

    </td>
  </tr>
  <tr>
    <td>
    	
    	<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/level.svg'; ?>"></div>
		<label>LEVEL</label>
		<div class="recipe-detailed-info"><?php echo $awesome_recipe_input_data['level']; ?></div>

    </td>
    <td>
    	
    	<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/time.svg'; ?>"></div>
		<label>TIME</label>
		<div class="recipe-detailed-info"><?php echo $awesome_recipe_input_data['time']; ?></div>

    </td> 
    <td>
    	

<div class="recipe-icon"><img class="recipe-info-img svg" src="<?php echo plugins_url() . '/awesome-recipe/assets/img/rating.svg'; ?>"></div>
		<label>RATING</label>
		<div class="recipe-detailed-info">
				<!-- Rating -->
				<?php 

				// Query for getting average ratings
					$average_rating = $wpdb->get_var(
					"SELECT AVG(`rating`) FROM `". $wpdb->prefix ."awesome_recipe_ratings`
					WHERE recipe_id='". $post->ID ."'"
					); 

				?>


				<div id="recipe_rating" class="rateit" data-rateit-resetable="false" data-rateit-value="<?php echo $average_rating; ?>" READONLY_PLACEHOLDER data-rid="<?php echo $post->ID; ?>">
				</div>

				<!-- END -->
			</div>		
		</div>

    </td>
  </tr>
</table>

<!--  END Short Details -->


<!--  Ingredients -->
<br>
<div class="recipe-body-header">
	<div class="recipe-header" style="background:#<?php echo  $styles->header_background; ?>;">
        <h4 style="font-size:<?php echo  $styles->header_font_size; ?>; text-transform: <?php echo  $styles->header_font_style; ?>; color:#<?php echo  $styles->header_font_color; ?>; ">ingredients</h4></div>
<!--  Frontend output Ingredients -->

<div class="input_fields_wrap">
    <?php
    if(isset($awesome_recipe_dynamic_input_data) && is_array($awesome_recipe_dynamic_input_data)) {
        $i = 1;
        $output = '';
     
        foreach($awesome_recipe_dynamic_input_data as $ingredients){
            
            $output = '<div class="input-items"><i class="fa fa-check" aria-hidden="true" ></i></i>
</i><span class="ingredient-item" style=" font-size:'. $styles->list_font_size . ';"><strong> '. $ingredients .'</strong></span></div>';
            
            echo $output;
            
            $i++;
        }

    } else {
       
    }
 
    ?>

</div>
<!-- END -->
</div> 
<!--  END Ingredients -->



<br>
<div class="recipe-body-header">
	<div class="recipe-header" style="background:#<?php echo  $styles->header_background; ?>;"> <h4 style="font-size:<?php echo  $styles->header_font_size; ?>; text-transform: <?php echo  $styles->header_font_style; ?>; color:#<?php echo  $styles->header_font_color; ?>; ">cooking procedure</h4></div>
<!-- Post Body-->

<div class="recipe-body"><?php echo   $awesome_recipe_instruction; ?></div>
<!-- END-->
</div>




<!--  Nutritions -->
<?php 

if ($awesome_recipe_dynamic_input_data_nutrition['0'] == NULL){ // check if the field is empty 

}else{


?>
<br>
<div class="recipe-body-header">
	<div class="recipe-header" style="background:#<?php echo  $styles->header_background; ?>;"><h4 style="font-size:<?php echo  $styles->header_font_size; ?>; text-transform: <?php echo  $styles->header_font_style; ?>; color:#<?php echo  $styles->header_font_color; ?>; ">nutrition facts</h4></div>
<!--  Frontend output Nutritions -->

<div class="input_fields_wrap">
    <?php
    if(isset($awesome_recipe_dynamic_input_data_nutrition) && is_array($awesome_recipe_dynamic_input_data_nutrition)) {
        $i = 1;
        $output = '';
     
        foreach($awesome_recipe_dynamic_input_data_nutrition as $nutritions){
            
            $output = '<div class="input-items"><i class="fa fa-hashtag" aria-hidden="true"></i><span class="ingredient-item" style=" font-size:'. $styles->list_font_size . ';"> <strong>'. $nutritions .'</strong></span></div>';
            
            echo $output;
            
            $i++;
        }

    } else {
       
    }
 
    ?>

</div>
<!-- END -->
</div> 

<?php
}// ends if loop
?>
<!--  END Nutritions -->

<!-- SHARE -->
<hr>

<label style="margin-bottom: 10px;"><strong>SHARE THIS RECIPE</strong></label>

<div class="awesome-recipe-share-container">


<?php



$URL = get_the_permalink();
$TITLE = get_the_title();
$DESCRIPTION = get_the_excerpt();
$MEDIA = get_the_post_thumbnail_url();


echo '<div class="awesome-recipe-share">';

echo '<a href="https://www.facebook.com/sharer/sharer.php?u='. $URL  .'" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/facebook.svg">';

echo '</a>';

echo '</div>';



echo '<div class="awesome-recipe-share">';

echo '<a href="https://plus.google.com/share?url='. $URL  .'" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/googlePlus.svg">';

echo '</a>';

echo '</div>';



echo '<div class="awesome-recipe-share">';

echo '<a href="http://twitter.com/share?'. $TITLE .'=&url='. $URL  .'" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/twitter.svg">';

echo '</a>';

echo '</div>';



echo '<div class="awesome-recipe-share">';

echo '<a href="https://pinterest.com/pin/create/button/?url='. $URL .'&media='. $MEDIA .'&description='. $DESCRIPTION  .'" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/pinterest.svg">';

echo '</a>';

echo '</div>';



echo '<div class="awesome-recipe-share">';

echo '<a href="http://www.tumblr.com/share/link?url='. $URL  .'" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/tumblr.svg">';

echo '</a>';

echo '</div>';



echo '<div class="awesome-recipe-share">';

echo '<a href="mailto:your@email.com?subject=Awesome Recipe Plugin" target="_blank">';

echo '<img src="' . plugins_url() . '/awesome-recipe/assets/img/email.svg">';

echo '</a>';

echo '</div>';



echo '</div>';

// END SHARE

} // ends function