<?php
function ntt_kid_widgets() {
		
	// Markup
	$widget_start_mu = '<div id="%1$s" class="%2$s widget cp" data-name="Widget">';
		$widget_start_mu .= '<div class="widget---cr">';
	    $widget_end_mu = '</div>';
    $widget_end_mu .= '</div>';
    
    $title_mu_start = '<div class="widget-name obj">';
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
add_action( 'ntt_before_entity_primary_heading_wp_hook', 'ntt_kid_primary_menu_aside' );
add_action( 'ntt_after_entity_primary_heading_wp_hook', 'ntt_kid_primary_axns_aside' );
add_action( 'ntt_after_entry_content_wp_hook', 'ntt_kid_entry_main_aside' );

/**
 * HTML CSS
 */
function ntt_kid_widgets_html_css( $classes ) {

    $disabled_css = '0';
    $enabled_css = '1';

    $r_widgets = array(
        'primary-menu-aside',
        'primary-axns-aside',
        'entry-main-aside',
    );

    foreach ( $r_widgets as $widget ) {
        if ( is_active_sidebar( $widget ) ) {
            $classes[] = $widget. '--'. $enabled_css;
        } else {
            $classes[] = $widget. '--'. $disabled_css;
        }
    }

	return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_widgets_html_css' );