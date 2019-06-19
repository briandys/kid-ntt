<?php
/**
 * Widgets
 */

function ntt_kid_widgets() {
		
	// Markup
	$widget_start_mu = '<div id="ntt--%1$s" class="ntt--%2$s widget cp" data-name="Widget">';
    $widget_end_mu = '</div>';
    
    $title_mu_start = '<div class="ntt--widget-name obj" data-name="Widget Name">';
        $title_mu_start .= '<span class="txt">';
        $title_mu_end = '</span>';
	$title_mu_end .= '</div>';
    
    // Primary Menu Aside
    register_sidebar( array(
		'name'          => __( 'Primary Menu Aside', 'ntt' ),
		'id'            => 'primary-menu-aside',
		'description'   => __( 'Located before Entity Primary Heading', 'ntt' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $title_mu_start,
		'after_title'   => $title_mu_end,
	 ) );
	
	function ntt_kid_primary_menu_aside() {
        $aside_name = 'Primary Menu Aside';
        
		if ( is_active_sidebar( sanitize_title( $aside_name ) )  ) {
			ntt_aside_markup( $aside_name );
		}
	}
	
	// Primary Actions Aside
    register_sidebar( array(
		'name'          => __( 'Primary Actions Aside', 'ntt' ),
		'id'            => 'primary-actions-aside',
		'description'   => __( 'Located after Entity Primary Heading', 'ntt' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $title_mu_start,
		'after_title'   => $title_mu_end,
	 ) );
	
	function ntt_kid_primary_axns_aside() {
        $aside_name = 'Primary Actions Aside';

		if ( is_active_sidebar( sanitize_title( $aside_name ) )  ) {
			ntt_aside_markup( $aside_name );
		}
    }
	
	// Entry Main Aside
    register_sidebar( array(
		'name'          => __( 'Entry Main Aside', 'ntt' ),
		'id'            => 'entry-main-aside',
		'description'   => __( 'Located within Entry Main', 'ntt' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $title_mu_start,
		'after_title'   => $title_mu_end,
	 ) );
	
	function ntt_kid_entry_main_aside() {
        $aside_name = 'Entry Main Aside';

		if ( is_active_sidebar( sanitize_title( $aside_name ) )  ) {
			ntt_aside_markup( $aside_name );
		}
    }
}
add_action( 'widgets_init', 'ntt_kid_widgets' );

// Insert the Widgets via WordPress Hooks
add_action( 'ntt_before_entity_primary_heading_wp_hook', 'ntt_kid_primary_menu_aside' );
add_action( 'ntt_after_entity_primary_heading_wp_hook', 'ntt_kid_primary_axns_aside' );
add_action( 'ntt_after_entry_content_wp_hook', 'ntt_kid_entry_main_aside' );

/**
 * HTML CSS
 */

function ntt_kid_widgets_html_css( $classes ) {

    /**
     * Entity Widgets Ability Status
     */

    $r_widgets = array(
        'primary-menu-aside',
        'primary-axns-aside',
        'entry-main-aside',
    );

    foreach ( $r_widgets as $widget ) {
        if ( is_active_sidebar( $widget ) ) {
            $classes[] = 'ntt--'. $widget. '---1';
        } else {
            $classes[] = 'ntt--'. $widget. '---0';
        }
    }

	return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_widgets_html_css' );