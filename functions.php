<?php
/**
 * Load child styles after the parent theme and its accessibility styles.
 */
function glendonits_spark_is_bootstrap5_page() {
	if ( is_page_template( 'home-page.php' ) || is_page( 'site-map' ) ) {
		return true;
	}

	return is_page() && (int) get_post_meta( get_queried_object_id(), 'spark_topic', true ) > 0;
}

function glendonits_spark_child_enqueue_styles() {
    $bootstrap5_page = glendonits_spark_is_bootstrap5_page();
    $module_page     = is_page() && (int) get_post_meta( get_queried_object_id(), 'spark_topic', true ) > 0;

    wp_enqueue_style(
        'glendonits-spark-ibm-plex',
        'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Sans+Condensed:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    if ( $bootstrap5_page ) {
        wp_dequeue_style( 'bootstrap' );
        wp_dequeue_style( 'smartmenus-style' );
        wp_dequeue_script( 'bootstrap-script' );
        wp_dequeue_script( 'bootstrap-tabcollapse' );
        wp_dequeue_script( 'bootstrap-smartmenus' );

        $bootstrap_path = get_stylesheet_directory() . '/assets/vendor/bootstrap-5.3.8';
        $bootstrap_uri  = get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-5.3.8';

        wp_enqueue_style(
            'glendonits-spark-bootstrap5',
            $bootstrap_uri . '/bootstrap.min.css',
            array( 'spark-accessibility' ),
            filemtime( $bootstrap_path . '/bootstrap.min.css' )
        );

        wp_enqueue_script(
            'glendonits-spark-bootstrap5',
            $bootstrap_uri . '/bootstrap.bundle.min.js',
            array(),
            filemtime( $bootstrap_path . '/bootstrap.bundle.min.js' ),
            true
        );
    }

    if ( is_page_template( 'home-page.php' ) ) {
        wp_enqueue_script(
            'glendonits-spark-legacy-homepage-media',
            get_template_directory_uri() . '/spark_gui.js',
            array( 'jquery' ),
            filemtime( get_template_directory() . '/spark_gui.js' ),
            true
        );

        wp_enqueue_script(
            'glendonits-spark-homepage',
            get_stylesheet_directory_uri() . '/assets/js/homepage.js',
            array( 'glendonits-spark-bootstrap5', 'glendonits-spark-legacy-homepage-media' ),
            filemtime( get_stylesheet_directory() . '/assets/js/homepage.js' ),
            true
        );
    } elseif ( $module_page ) {
        wp_enqueue_style(
            'glendonits-spark-module-dialog',
            get_template_directory_uri() . '/dialog.css',
            array( 'glendonits-spark-bootstrap5' ),
            filemtime( get_template_directory() . '/dialog.css' )
        );
        wp_enqueue_style(
            'glendonits-spark-module-gui',
            get_template_directory_uri() . '/spark_gui.css',
            array( 'glendonits-spark-bootstrap5' ),
            filemtime( get_template_directory() . '/spark_gui.css' )
        );
        wp_enqueue_script(
        'glendonits-spark-module-content',
        get_template_directory_uri() . '/spark_content.js',
        array( 'jquery' ),
        filemtime( get_template_directory() . '/spark_content.js' ),
        true
        );
        wp_add_inline_script(
        'glendonits-spark-module-content',
        'var baseUrl = ' . wp_json_encode( home_url() ) . ';',
        'before'
        );
        wp_enqueue_script(
            'glendonits-spark-module-navigation',
            get_stylesheet_directory_uri() . '/assets/js/module-navigation.js',
            array(),
            filemtime( get_stylesheet_directory() . '/assets/js/module-navigation.js' ),
            true
        );
        wp_add_inline_script(
            'accordion-shortcodes-script',
            'if ( Array.isArray( window.accordionShortcodesSettings ) ) {
                window.accordionShortcodesSettings.forEach( function ( settings ) {
                    settings.clickToClose = true;
                } );
            }',
            'after'
        );
    }

    $style_dependencies = array( 'spark-accessibility', 'glendonits-spark-ibm-plex' );
    if ( $bootstrap5_page ) {
        $style_dependencies[] = 'glendonits-spark-bootstrap5';
    }
    if ( $module_page ) {
        $style_dependencies[] = 'glendonits-spark-module-dialog';
        $style_dependencies[] = 'glendonits-spark-module-gui';
    }

    wp_enqueue_style(
        'glendonits-spark-child-style',
        get_stylesheet_uri(),
        $style_dependencies,
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'glendonits_spark_child_enqueue_styles', 20 );
