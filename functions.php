<?php
/**
 * Load child styles after the parent theme and its accessibility styles.
 */
function glendonits_spark_child_enqueue_styles() {
    wp_enqueue_style(
        'glendonits-spark-child-style',
        get_stylesheet_uri(),
        array( 'spark-accessibility' ),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'glendonits_spark_child_enqueue_styles', 20 );
