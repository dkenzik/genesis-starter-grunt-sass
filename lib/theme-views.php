<?php

/**
 * Custom queries, hooks, etc go here
 */

// Change default layout
genesis_set_default_layout( 'sidebar-content' );

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