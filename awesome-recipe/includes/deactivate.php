<?php

/**
* Triggers when deactivate the plugin.
*
*@package AwesomeRecipePlugin
*/

function awesome_recipe_deactivation(){

	flush_rewrite_rules();
}