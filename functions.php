<?php

function custom_theme_assets() {

	//wp_enqueue_script( 'bulma-scripts', get_stylesheet_directory_uri() . '/bulma-sass/bulma-scripts.js',array(), false, true );


	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'epr-styles', get_stylesheet_directory_uri().'/epr-styles.css' );

	//wp_enqueue_script( 'bootstrapjs', get_template_directory_uri()  . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array(), false, array('strategy'  => 'defer',) );
	wp_enqueue_script( 'bootstrapjs', get_template_directory_uri()  . '/assets/js/bootstrap.bundle.min.js', array(), false, array('strategy'  => 'defer',) );
}

add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );

register_nav_menus( [ 'primary' => __( 'Primary Menu' ) ] );

// Menu functions
// Taken from :
// How to create a custom nav menu in WordPress
// https://joeyfarruggio.com/wordpress/custom-nav-menu/
// Select the menu
//$menu = my_menu_builder('main-menu');
//And loop through the items.
//foreach ($menu as $item) :

function menu_item_has_children($menu, $parent_id) {
	$parent_IDs = array_column($menu, 'menu_item_parent');
	$found_menu_items = array_search($parent_id, $parent_IDs);

	return $found_menu_items;
}


function my_menu_builder($menu_id = '') {
	$menu = wp_get_nav_menu_items($menu_id);
	$new_menu = array();
	
	foreach ($menu as $item) {
		// If menu item has children
		if (menu_item_has_children($menu, $item->ID) != false) {
			$new_menu[] = [
				'ID' => url_to_postid($item->url),
				'title' => $item->title,
				'url' => $item->url,
				'children' => []
			];
			continue;
		}

		// If menu item is a child
		if ($item->menu_item_parent != 0)  {
         /** 
          * Children menu items are preceeded by their parent.
          * That means we can safely assume the last menu item is the parent
          */
			$parent = array_key_last($new_menu);
			array_push($new_menu[$parent]['children'],
				[
					'ID' => url_to_postid($item->url),
					'title' => $item->title,
					'url' => $item->url,
				]);
			continue;
		}

		// Just a normal menu item
		$new_menu[] = [
			'ID' => url_to_postid($item->url),
			'title' => $item->title,
			'url' => $item->url,
		];

	}
	return $new_menu;
}


//Helpers
function my_console_log(...$data) {
    $json = json_encode($data);
    add_action('shutdown', function() use ($json) {
       echo "<script>console.log({$json})</script>";
    });
}

