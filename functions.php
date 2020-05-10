<?php
/**
 * Functions
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/*
BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/EA-Starter/wiki
Devs, contact me if you need access
*/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 768;

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function ea_global_enqueues() {

	// javascript
	if( ! ea_is_amp() ) {
		wp_enqueue_script( 'ea-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global-min.js' ), true );

		// Move jQuery to footer
		if( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
			wp_enqueue_script( 'jquery' );
		}

	}

	// css
	wp_dequeue_style( 'child-theme' );
	wp_enqueue_style( 'ea-fonts', setup_be_theme_fonts_url() );
	wp_enqueue_style( 'ea-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
}
add_action( 'wp_enqueue_scripts', 'ea_global_enqueues' );

/**
 * Enqueue Non-Critical CSS
 *
 */
function ea_enqueue_noncritical_css() {
	wp_enqueue_style( 'wp-block-library' );
	wp_enqueue_style( 'ea-critical' );
	wp_enqueue_style( 'ea-style' );
	wp_enqueue_style( 'ea-fonts' );
}

/**
 * Gutenberg scripts and styles
 *
 */
function ea_gutenberg_scripts() {
	wp_enqueue_style( 'ea-fonts', setup_be_theme_fonts_url() );
	wp_enqueue_script( 'ea-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'ea_gutenberg_scripts' );

/**
 * Theme Fonts URL
 *
 */
function setup_be_theme_fonts_url() {
	//return false;
	wp_enqueue_style( 'setup_be_google-font', '//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Arvo:400,400i,700', array(), genesis_get_theme_version() );
}

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function ea_child_theme_setup() {

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );

	// General cleanup
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );

	// Theme
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/layouts.php' );
	include_once( get_stylesheet_directory() . '/inc/custom-logo-setup-trv.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/loop-setup-starter-custax.php' );
	include_once( get_stylesheet_directory() . '/inc/author-box.php' );
	include_once( get_stylesheet_directory() . '/inc/template-tags.php' );
	include_once( get_stylesheet_directory() . '/inc/site-footer-swp.php' );

	// Editor
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/tinymce.php' );

	// Functionality
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
	include_once( get_stylesheet_directory() . '/inc/block-area.php' );
	include_once( get_stylesheet_directory() . '/inc/social-links.php' );

	// Plugin Support
	include_once( get_stylesheet_directory() . '/inc/acf.php' );
	include_once( get_stylesheet_directory() . '/inc/amp.php' );
	include_once( get_stylesheet_directory() . '/inc/shared-counts.php' );
	include_once( get_stylesheet_directory() . '/inc/wpforms.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Image Sizes
	// add_image_size( 'ea_featured', 400, 100, true );

	// Gutenberg

	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	//add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Tiny', 'setup_be' ),
			'shortName' => __( 'T', 'setup_be' ),
			'size'      => 12,
			'slug'      => 'tiny'
		),
		array(
			'name'      => __( 'Smaller', 'setup_be' ),
			'shortName' => __( 'S2', 'setup_be' ),
			'size'      => 14,
			'slug'      => 'smaller'
		),
		array(
			'name'      => __( 'Base', 'setup_be' ),
			'shortName' => __( 'B', 'setup_be' ),
			'size'      => 16,
			'slug'      => 'base'
		),
		array(
			'name'      => __( 'Normal', 'setup_be' ),
			'shortName' => __( 'N', 'setup_be' ),
			'size'      => 18,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Small', 'setup_be' ),
			'shortName' => __( 'S', 'setup_be' ),
			'size'      => 20,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Medium', 'setup_be' ),
			'shortName' => __( 'M', 'setup_be' ),
			'size'      => 24,
			'slug'      => 'medium'
		),
		array(
			'name'      => __( 'Large', 'setup_be' ),
			'shortName' => __( 'L', 'setup_be' ),
			'size'      => 36,
			'slug'      => 'large'
		),
		array(
			'name'      => __( 'Huge', 'setup_be' ),
			'shortName' => __( 'H', 'setup_be' ),
			'size'      => 48,
			'slug'      => 'huge'
		),
	) );

	// -- Disable Custom Colors
	//add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'ea_genesis_child' ),
			'slug'  => 'blue',
			'color'	=> '#56a5e5',
		),
		array(
			'name'  => __( 'Red', 'ea_genesis_child' ),
			'slug'  => 'red',
			'color'	=> '#e5565b',
		),
		array(
			'name'  => __( 'Orange', 'ea_genesis_child' ),
			'slug'  => 'orange',
			'color'	=> '#e59856',
		),
		array(
			'name'  => __( 'Yellow', 'ea_genesis_child' ),
			'slug'  => 'yellow',
			'color'	=> '#ffff00',
		),
		array(
			'name'  => __( 'Green', 'ea_genesis_child' ),
			'slug'  => 'green',
			'color'	=> '#a2e556',
		),
		array(
			'name'  => __( 'Light Grey', 'ea_genesis_child' ),
			'slug'  => 'lightgrey',
			'color' => '#F5F5F5',
		),
		array(
			'name'  => __( 'Grey', 'ea_genesis_child' ),
			'slug'  => 'grey',
			'color' => '#BDBDBD',
		),
		array(
			'name'  => __( 'Dark Grey', 'ea_genesis_child' ),
			'slug'  => 'darkgrey',
			'color' => '#616161',
		),
	) );

}
add_action( 'genesis_setup', 'ea_child_theme_setup', 15 );

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function ea_comment_text( $args ) {
	$args['title_reply']          = __( 'Leave A Reply', 'ea_genesis_child' );
	$args['label_submit']         = __( 'Post Comment',  'ea_genesis_child' );
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';
	return $args;
}
add_filter( 'comment_form_defaults', 'ea_comment_text' );


/**
 * Template Hierarchy
 *
 */
function ea_template_hierarchy( $template ) {
	if( is_home() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'ea_template_hierarchy' );
