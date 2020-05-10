<?php
/**
 * Archive
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Full Width
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );


/**
 * Blog Archive Body Class
 *
 */
function ea_blog_archive_body_class( $classes ) {
    $classes[] = 'archive';
    return $classes;
}
add_filter( 'body_class', 'ea_blog_archive_body_class' );

// Move breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_archive_title_descriptions', 'genesis_do_breadcrumbs', 8 );

// Remove description on paginated archives
if( get_query_var( 'paged' ) ) {
    remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12, 3 );
}

// Add divider
if( !function_exists( 'setup_starter_add_divider' ) ) {

    function setup_starter_add_divider( $divider, $contents ) {

        $out = ''; // declare empty variable for AWS environments

        if( is_array( $contents ) ) {

            // $contents is an array
            for( $x=0; $x<=count( $contents ); $x++ ) {
                
                $out .= $contents[ $x ];
                
                if( ( $x + 1 ) < count( $contents ) ) {

                    $out .= ' '.$divider.' ';

                }

            }

            return $out;

        } else {

            // $contents is not an array | return
            return $contents;
        }

    }

}

genesis();
