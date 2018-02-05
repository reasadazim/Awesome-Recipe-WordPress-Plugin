<?php

/**
* Save recipe post.
*
*@package AwesomeRecipePlugin
*/



// Creates the exterpt field required for Recipe post type

function mandatory_excerpt($data) {

  // If the post type is Recipe
  if ( 'recipe' == $data['post_type'] ) { 
     
  $excerpt = $data['post_excerpt'];

  if (empty($excerpt)) { // If excerpt field is empty

      // Check if the data is not drafed and trashed
      if ( ( $data['post_status'] != 'draft' ) && ( $data['post_status'] != 'trash' ) ){

        $data['post_status'] = 'draft';

        // Add filter to redirect error location
      add_filter('redirect_post_location', 'excerpt_error_message_redirect', '99'); 
        
      }
    }
  }
 
  return $data;
}

add_filter('wp_insert_post_data', 'mandatory_excerpt'); // Check exerpt field exists or not



// Redirect to error location

function excerpt_error_message_redirect($location) {

  $location = str_replace('&message=6', '', $location);

  return add_query_arg('excerpt_required', 1, $location); 

}

// Display error notice

function excerpt_admin_notice() {

  if (!isset($_GET['excerpt_required'])) return;

  switch (absint($_GET['excerpt_required'])) {

    case 1:

      $message = 'Excerpt field is empty! Excerpt is required to publish your recipe post.';

      break;

    default:

      $message = 'Unexpected error';
  }

  echo '<div id="notice" class="error"><p>' . $message . '</p></div>';

}


add_action('admin_notices', 'excerpt_admin_notice');



// Save post

function awesome_recipe_save_post_admin( $post_id, $post, $update ){


  // If it is a new post then do not update.

  if( !$update ){
    return;
  }

  
 if (isset($_POST['awesome_recipe_inputTime'])) {
     
  // sanitizing custom input fields
  
  $awesome_recipe_input_data = array(); // Creating an array to hold user input data.
     
  // If the input fields has value then sanittize it and assign it to corresponding array index

  $awesome_recipe_input_data['time'] = sanitize_text_field( $_POST['awesome_recipe_inputTime'] ) ;
  $awesome_recipe_input_data['level'] = sanitize_text_field( $_POST['awesome_recipe_inputLevel'] ) ;
  $awesome_recipe_input_data['course'] = sanitize_text_field( $_POST['awesome_recipe_inputCourse'] ) ;
  $awesome_recipe_input_data['cuisine'] = sanitize_text_field( $_POST['awesome_recipe_inputCuisine'] ) ;
  $awesome_recipe_input_data['serving'] = sanitize_text_field( $_POST['awesome_recipe_inputServing'] ) ;
  $awesome_recipe_input_data['rating'] = 0;
  $awesome_recipe_input_data['rating_count'] = 0;
  
  // if the post exists then update otherwise create a new post.

  update_post_meta( $post_id, 'awesome_recipe_input_data', $awesome_recipe_input_data );
}

 
  


  // Following code saves dynamic field data (Ingredients)

  if( $update ){ // if user updates the post
    
    if(isset($_POST['awesome_recipe_dynamic_input_data'])) {

          // $post_id, $meta_key, $meta_value
          update_post_meta( $post_id, 'awesome_recipe_dynamic_input_data', $_POST['awesome_recipe_dynamic_input_data'] );
      }
  }else{ // if user creates new post

  if(isset($_POST['awesome_recipe_dynamic_input_data'])) {

        // $post_id, $meta_key, $meta_value
        add_post_meta( $post_id, 'awesome_recipe_dynamic_input_data', $_POST['awesome_recipe_dynamic_input_data'] );
    }

  }    



  // Following code saves TinyMCE field data (Cooking Procedure)

  /* Do the checks */
    if ( ! isset( $_POST['awesome_recipe_instruction_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['awesome_recipe_instruction_nonce'], 'awesome_recipe_instruction_meta_box' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

  /* If check passed then save */
    $awesome_recipe_instruction = $_POST['awesome_recipe_instruction'];

    update_post_meta( $post_id, 'awesome_recipe_instruction', $awesome_recipe_instruction);





  // Following code saves dynamic field data (Nutritions)

  if( $update ){ // if user updates the post
    
    if(isset($_POST['awesome_recipe_dynamic_input_data_nutrition'])) {

          // $post_id, $meta_key, $meta_value
          update_post_meta( $post_id, 'awesome_recipe_dynamic_input_data_nutrition', $_POST['awesome_recipe_dynamic_input_data_nutrition'] );
      }
  }else{ // if user creates new post

  if(isset($_POST['awesome_recipe_dynamic_input_data_nutrition'])) {
      
        // $post_id, $meta_key, $meta_value
        add_post_meta( $post_id, 'awesome_recipe_dynamic_input_data_nutrition', $_POST['awesome_recipe_dynamic_input_data_nutrition'] );
    }

  }    

  
}