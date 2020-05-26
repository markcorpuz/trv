<?php
/**
 * Template Tags
 *
 * @package      SETUP-BE
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/


/**
 * IMPORTANT NOTES
 *
 * Bill's code is retained because a lot of his functions are being used on other layouts (like regular posts).
 * Since I can't determine where those dependencies are, I just leave them (prefixed by ea_).
 * But moving forward, I'm using my own module/item(s) structure & logic.
 */


/**
 * FEATURED IMAGE
 * 
 */

function ea_post_summary_image( $size = 'thumbnail_medium' ) {
	echo '<a class="post-summary__image" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( ea_entry_image_id(), $size ) . '</a>';
}

function setup_be_image( $size = 'thumbnail_medium' ) {
	echo '<a class="item image link" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( ea_entry_image_id(), $size ) . '</a>';
}
function setup_be_image_nolink( $size = 'thumbnail_medium' ) {
	echo wp_get_attachment_image( ea_entry_image_id(), $size );
}

/**
 * Entry Image ID
 *
 */

function ea_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_ea_default_image' );
}


/**
 * OVERLINE
 * 
 */

function ea_entry_category() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<p class="entry-category"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></p>';
}

function setup_be_overline() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<div class="item overline"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></div>';
}
function setup_be_overline_nolink() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<div class="item overline">' . $term->name . '</div>';
}


/**
 * TITLE
 * 
 */

function ea_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

function setup_be_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="item title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}
function setup_be_title_nolink() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="item title">' . get_the_title() . '</' . $tag . '>';
}

/**
 * AUTHOR
 *
 */

function ea_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<div class="item author">By <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
}

	/**
	 * AUTHOR (name only)
	 *
	 */
	function setup_be_author_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author"><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}
	function setup_be_author_by_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author">By <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}

	/**
	 * AUTHOR ICON (icon w name)
	 *
	 */
	function setup_be_author_gravatar_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><a class="item author gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a><span><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}
	function setup_be_author_gravatar_by_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><a class="item author gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a>by&nbsp;<span><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}

	/**
	 * AUTHOR ICONONLY (icon only)
	 *
	 */
	function setup_be_author_gravatar() {
		$id = get_the_author_meta( 'ID' );
		echo '<a class="item author gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a>';
	}


/**
 * DATE
 *
 */

	/**
	 * DATE (Jan 3, 2020)
	 *
	 */
	function setup_be_date_mdy() {
		echo '<div class="item date">' . get_the_date( 'M j, Y' ) . '</div>';
	}
	/**
	 * MONTH |  DATE (Oct | Jan 3, 2020)
	 *
	 */
	function setup_be_date_weekday_mdy() {
		echo '<div class="item date">' . get_the_date( 'D | M j, Y' ) . '</div>';
	}


/**
 * DATE & AUTHOR
 * 
 */

	/**
	 * DATE by AUTHOR (Jan 3, 2020 By Mark)
	 *
	 */
	function setup_be_date_by_author_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="items date_by_author_name">';
		echo '<span class="item date">' . get_the_date( 'M j, Y' ) . '</span>';
		echo '<span class="item author">By <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></span>';
		echo '</div>';
	}
	/**
	 * DATE vbar AUTHOR (Jan 3, 2020 | Mark)
	 *
	 */
	function setup_be_date_vbar_author_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="items date_vbar_author_name">';
		echo '<span class="item date">' . get_the_date( 'M j, Y' ) . '</span>';
		echo '<span class="item vbar"> | </span>';
		echo '<span class="item author"><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></span>';
		echo '</div>';
	}


/**
 * EXCERPT
 *
 */

	/**
	 * EXCERPT ONLY
	 * 
	 */
	function setup_be_excerpt() {
	    if( has_excerpt() ) {
	    	echo '<div class="item excerpt">' . get_the_excerpt() . '</div>';
	    } else {
	    	//echo '';
	    }
	}

	/**
	 * EXCERPT OR MAX WORDS
	 * 
	 */
	function setup_be_excerpt_maxwords() {
	    $max_words = 10;
	    $the_excerpt = get_the_excerpt();
	    if( $the_excerpt ) {
	        echo '<div class="item excerpt">'.wp_trim_words( $the_excerpt, $max_words ).'</div>';
	    }
	}