<?php

/**
 * Custom queries, hooks, etc go here
 */

// Change default layout
genesis_set_default_layout( 'sidebar-content' );

// Swap sidebars
add_action( 'genesis_after_header', 'change_sidebar_order' );

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );


/**
 * Swap Primary and Secondary Sidebars on Sidebar-Sidebar-Content
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/switch-genesis-sidebars/
 */
function change_sidebar_order() {

  $site_layout = genesis_site_layout();

  if ( 'sidebar-content-sidebar' == $site_layout ) {
    // Remove the Primary Sidebar from the Primary Sidebar area.
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

    // Remove the Secondary Sidebar from the Secondary Sidebar area.
    remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );

    // Place the Secondary Sidebar into the Primary Sidebar area.
    add_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );

    // Place the Primary Sidebar into the Secondary Sidebar area.
    add_action( 'genesis_sidebar_alt', 'genesis_do_sidebar' );
  } 

}

// Setup Utility Bar
genesis_register_sidebar( array(
  'id' => 'utility-bar-left',
  'name' => __( 'Utility Bar Left', 'theme-prefix' ),
  'description' => __( 'This is the left utility bar above the header.', 'theme-prefix' ),
  ) 
);

genesis_register_sidebar( array(
  'id' => 'utility-bar-right',
  'name' => __( 'Utility Bar Right', 'theme-prefix' ),
  'description' => __( 'This is the right utility bar above the header.', 'theme-prefix' ),
  ) 
);

add_action( 'genesis_before_header', 'utility_bar' );

function utility_bar() {

  echo '<div class="utility-bar"><div class="wrap">';

  genesis_widget_area( 'utility-bar-left', array(
    'before' => '<div class="utility-bar-left">',
    'after' => '</div>',
  ) );
 
  genesis_widget_area( 'utility-bar-right', array(
    'before' => '<div class="utility-bar-right">',
    'after' => '</div>',
  ) );
 
  echo '</div></div>';
}

// Render hero
add_action( 'genesis_after_header', 'output_hero');
function output_hero() {
  $slider = get_field('slider');
  // print_r($slider);
  if(function_exists('soliloquy') && isset($slider->ID)) {
    soliloquy($slider->ID);
  }
}