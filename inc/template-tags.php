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
 * Entry Category
 *
 */
function ea_entry_category() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<p class="entry-category"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></p>';
}

/**
 * Overline
 *
 */
function setup_be_overline() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<p class="item overline"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></p>';
}

/**
 * Post Summary Title
 *
 */
function ea_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}
function setup_be_title_post_summary() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="item title post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

/**
 * Post Summary Image
 *
 */
function ea_post_summary_image( $size = 'thumbnail_medium' ) {
	echo '<a class="post-summary__image" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( ea_entry_image_id(), $size ) . '</a>';
}
function setup_be_image_post_summary( $size = 'thumbnail_medium' ) {
	echo '<a class="item image post-summary__image" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( ea_entry_image_id(), $size ) . '</a>';
}


/**
 * Entry Image ID
 *
 */
function ea_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_ea_default_image' );
}

/**
 * Entry Author
 *
 */
function ea_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></p>';
}

// AUTHOR

	/**
	 * AUTHOR (name only)
	 *
	 */
	function setup_be_author_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author"><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}

	/**
	 * AUTHOR ICON (icon w name)
	 *
	 */
	function setup_be_author_gravatar_name() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><a class="item author gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a>by&nbsp;<span><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}

	/**
	 * AUTHOR ICONONLY (icon)
	 *
	 */
	function setup_be_author_gravatar() {
		$id = get_the_author_meta( 'ID' );
		echo '<a class="item author gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a>';
	}

/**
 * Date Published
 * 
 */
function setup_be_date_published() {
	echo '<p class="item date">' . get_the_date( 'M d Y' ) . '</p>';
}

/**
 * Date & Author
 * 
 */
function setup_be_date_published_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<div class="items meta">';
	echo '<span class="item date">' . get_the_date( 'M d Y' ) . ' </span>';
	echo '<span class="item author">by <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></span>';
	echo '</div>';
}

/**
 * Excerpt or Max Words
 * 
 */
function setup_be_excerpt() {
    $max_words = 10;
    $the_excerpt = get_the_excerpt();
    if( $the_excerpt ) {
        echo '<div class="item excerpt">'.wp_trim_words( $the_excerpt, $max_words ).'</div>';
    }
}
/**
 * Excerpt Only
 * 
 */
function setup_be_excerpt_only() {
    if( has_excerpt() ) {
    	echo '<div class="item excerpt">' . get_the_excerpt() . '</div>';
    } else {
    	echo '';
    }
}