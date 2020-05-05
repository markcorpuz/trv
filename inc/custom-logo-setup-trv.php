<?php
/**
 * Custom Logo
 * Guide Source: 
 * https://rainastudio.com/add-custom-logo-to-genesis-child-theme/
 * https://www.billerickson.net/code/add-site-description-to-site-title/
 * https://www.billerickson.net/code/custom-logo/
 *
 * @package      SETUP-STARTER
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Add custom logo or Enable option in Customizer > Site Identity
add_theme_support( 'custom-logo', array(
	'width'       	=> 400,
	'height'      	=> 100,
	'flex-width'	=> true,
	'flex-height' 	=> true,
	'header-text' 	=> array( '.site-title', '.site-description' ),
) );

// Display custom logo
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

/**
 * Add Site Description to Title 
 *
 */
function be_desc_in_title( $title, $inside, $wrap ) {

	$inside = '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . ' <span class="desc">' . get_bloginfo( 'description' ) . '</span></a>';
	
	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';
	return $title;	
}
//add_filter( 'genesis_seo_title', 'be_desc_in_title', 10, 3 );