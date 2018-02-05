jQuery(function($){



// Adds dynamic ingredients fields
var max_fields      = 100; //maximum input boxes allowed
var wrapper         = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID
    
var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data[]" placeholder="e.g. Flower 100gm"><a href="#" class="remove_field"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>'); //add input box
    }
});
    
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); 
    $(this).parent('div').remove(); x--;
});



// Add dynamic nutrition fields

var wrapper_nutrition         = $(".input_fields_wrap_nutrition"); //Fields wrapper
var add_button_nutrition      = $(".add_field_button_nutrition"); //Add button ID
    
var y = 1; //initlal text box count
$(add_button_nutrition).click(function(e){ //on add input button click
    e.preventDefault();
    if(y < max_fields){ //max input box allowed
        y++; //text box increment
        $(wrapper_nutrition).append('<div class="input-spacing"><input class="form-control" type="text" name="awesome_recipe_dynamic_input_data_nutrition[]" placeholder="e.g. Carbohydrate 200mg"><a href="#" class="remove_field"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>'); //add input box
    }
});
    
$(wrapper_nutrition).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); 
    $(this).parent('div').remove(); y--;
});

//  Save TinyMCE data
jQuery('#submit').mousedown( function() {
    tinyMCE.triggerSave();

});



});

