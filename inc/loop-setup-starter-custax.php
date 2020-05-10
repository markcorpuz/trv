<?php
/**
 * Loop
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Use Archive Loop
 *
 */
function setup_starter_custax_season() {

	if( ! is_singular() && ! is_404() ) {
		    
	    // generic archive taxonomy page
	    if( is_tax( 'podcast_season' ) ) {
	        add_action( 'genesis_loop', 'setup_starter_custax_season_loop' );
	        setup_starter_remove_bills(); // remove Bill's archive loop version
	    }
		
		// remove default Genesis archive loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

	}

}
add_action( 'template_redirect', 'setup_starter_custax_season', 20 );

/**
 * Archive Loop | TAXONOMY
 * Uses template partials
 */
function setup_starter_custax_season_loop() {

	if ( have_posts() ) {
        
		do_action( 'genesis_before_while' );

		while ( have_posts() ) {

			the_post();
			do_action( 'genesis_before_entry' );
            
			// Template part
			$partial = apply_filters( 'ea_loop_partial', 'taxonomy' );
			$context = apply_filters( 'ea_loop_partial_context', is_search() ? 'search' : get_post_type() );
			get_template_part( 'partials/' . $partial, $context );

			do_action( 'genesis_after_entry' );

		}

		do_action( 'genesis_after_endwhile' );

	} else {

		do_action( 'genesis_loop_else' );

	}

}

// this function just removes Bill's archive loop version
function setup_starter_remove_bills() {
    remove_action( 'genesis_loop', 'ea_archive_loop' );
    return true;
}
