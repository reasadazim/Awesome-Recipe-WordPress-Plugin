<?php

/**
* Creating meta box
*
*@package AwesomeRecipePlugin
*/

function awesome_recipe_options( $post ){

	$awesome_recipe_input_data = get_post_meta( $post->ID, 'awesome_recipe_input_data', true ); // Getting post data to dispay user input values to custom fields.
    $awesome_recipe_dynamic_input_data =   get_post_meta($post->ID, 'awesome_recipe_dynamic_input_data', true); // For dynamic fields (ingredients)

	// If $awesome_recipe_input_data is empty then display empty fields
	if( empty($awesome_recipe_input_data) ){
		$awesome_recipe_input_data = array(
			'time' => '',
			'lebel' => 'Select',
            'course' => '',
            'cuisine' => '',
            'serving' => ''
		);
	}
    
    $awesome_recipe_dynamic_input_data_nutrition = get_post_meta($post->ID, 'awesome_recipe_dynamic_input_data_nutrition', true); // For dynamic fields (ingredients)

    // Check if arry key exists or not (otherwise dispays notice inside input field)
    if (array_key_exists('course', $awesome_recipe_input_data)){ // check if the field is empty or not

    }else{
    $awesome_recipe_input_data['cuisine'] = '';
    $awesome_recipe_input_data['course'] = '';
    }


?>


<!-- START Admin Input Form-->

<!-- People Serve -->
<br>
<div class="form-group">
    <label>Persons Serving</label>
    <input type="number" class="form-control" name="awesome_recipe_inputServing" value="<?php echo $awesome_recipe_input_data['serving']; ?>" placeholder="e.g. 2" >
</div>
<!-- END People Serve -->


<!-- Course -->
<br>
<div class="form-group">
    <label>Course</label>
    <input type="text" class="form-control" name="awesome_recipe_inputCourse" value="<?php echo $awesome_recipe_input_data['course']; ?>" placeholder="e.g. Appetizers">
</div>
<!-- END Course -->


<!-- Cuisine -->
<br>
<div class="form-group">
    <label>Cuisine</label>
    <input type="text" class="form-control" name="awesome_recipe_inputCuisine" value="<?php echo $awesome_recipe_input_data['cuisine']; ?>" placeholder="e.g. Italian">
</div>
<!-- END Cuisine -->


<!-- Skill Level-->
<br>
<div class="form-group">
    <label>Skill level</label>
    <select class="form-control" name="awesome_recipe_inputLevel">
		
        <option value="Select">Select</option>
       

        <option value="Beginner" 

          <?php 
          if (array_key_exists('level', $awesome_recipe_input_data)) { // checks if array key exists
                if ($awesome_recipe_input_data['level']=="Beginner"){ // check if it matches with array index data or not
                echo "SELECTED";  
                }
            }
          ?>


        >Beginner</option>


        <option value="Intermediate" 

          <?php  
          if (array_key_exists('level', $awesome_recipe_input_data)) {
                if ($awesome_recipe_input_data['level']=="Intermediate"){
                    echo "SELECTED";  
                }
            }
         ?>

         >Intermediate</option>


         <option value="Expert"

         <?php 
            if (array_key_exists('level', $awesome_recipe_input_data)) {
                if ($awesome_recipe_input_data['level']=="Expert"){
                    echo "SELECTED";  
                }
            }
         ?>

         >Expert</option>

    </select>
</div>
<!-- END Skill Level-->


<!-- Cooking Time -->
<br>
<div class="form-group">
    <label>Time Required</label>
    <input type="text" class="form-control" name="awesome_recipe_inputTime" value="<?php echo $awesome_recipe_input_data['time']; ?>" placeholder="e.g. 20 Minutes">
</div>
<!-- END Cooking Time -->

<!-- Ingredients -->
<br>
<div class="form-group">

<!--  Dynamic Meta Input Boxes For dynamic fields (ingredients) -->
<div class="input_fields_wrap">
      <label>Ingredients</label>
    <?php
    if(isset($awesome_recipe_dynamic_input_data) && is_array($awesome_recipe_dynamic_input_data)) {
        $i = 1;
        $output = '';

        foreach($awesome_recipe_dynamic_input_data as $ingredients){
            
            $output = '<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data[]" value="' . $ingredients . '" >';
            if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>';
            else $output .= '</div>';
            
            echo $output;
            $i++;
        }
    } else {
        echo '<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data[]" placeholder="e.g. Flower 100gm"></div>';
    }
    ?>

</div>
<a class="add_field_button button-secondary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Ingredients Field</a><br>
<!-- END -->


</div>

<!-- END Ingredients -->



<!-- Instruction Editor -->
<br>
<div class="form-group">
<label>Cooking Procedure</label><br>
<?php



// Adds TinyMCE editor
wp_nonce_field( 'awesome_recipe_instruction_meta_box', 'awesome_recipe_instruction_nonce' );
    $awesome_recipe_instruction = get_post_meta( $post->ID, 'awesome_recipe_instruction', true );



// Adding features to tinyMCE
$tinymce_opt = array(
 'toolbar1' => "fontselect, styleselect,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,forecolor,removeformat,charmap,undo,redo"
);

    // Add WP Editor as replacement of textarea 
    wp_editor( $awesome_recipe_instruction, 'awesome_recipe_instruction', array(
        'wpautop'       => false,
        'media_buttons' => true,
        'textarea_name' => 'awesome_recipe_instruction',  
        'textarea_rows' => 20,
        'teeny'         => true,
        'quicktags' => true,
        'tinymce' => $tinymce_opt,
        'quicktags' => true
    ) );



?>

</div>
<!-- END Instruction Editor -->



<!-- Nutritions -->
<div class="form-group">


<!--  Dynamic Meta Input Boxes For dynamic fields (Nutritions) -->
<div class="input_fields_wrap_nutrition">
      <label>Nutrition Facts</label><em> (Optional)</em>
    <?php
    if(isset($awesome_recipe_dynamic_input_data_nutrition) && is_array($awesome_recipe_dynamic_input_data_nutrition)) {
        $i = 1;
        $output = '';

        foreach($awesome_recipe_dynamic_input_data_nutrition as $nutrutuions){
            
            $output = '<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data_nutrition[]" value="' . $nutrutuions . '" >';
            if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>';
            else $output .= '</div>';
            
            echo $output;
            $i++;
        }
    } else {
        echo '<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data_nutrition[]" placeholder="e.g. Carbohydrate 200mg"></div>';
    }
    ?>

</div>
<a class="add_field_button_nutrition button-secondary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Nutrition Field</a><br>
<!-- END -->


</div>

<!-- END Nutritions -->

<!-- END Admin Input Form-->


<?php

} 


