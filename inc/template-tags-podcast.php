<?php
/**
 * Template Tags - PODCAST
 *
 * @package      TRV
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/


/**
 * IMAGE - PODCAST_PIC
 * 
 */

function trv_image_podcast_pic( $size = 'medium' ) {
	echo '<a class="item image link podcast_pic" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( get_post_meta( get_the_ID(), "podcast_pic", TRUE ), 'medium' ) . '</a>';
}
function trv_image_podcast_pic_nolink( $size = 'thumbnail_medium' ) {
	echo wp_get_attachment_image( get_post_meta( get_the_ID(), "podcast_pic", TRUE ), 'thumbnail_medium' );
}


/**
 * TITLE - PODCAST_TITLE
 * 
 */

function trv_title_podcast_title() {
	echo '<div class="item title link podcast_title"><a href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . get_post_meta( get_the_ID(), "podcast_title", TRUE ) . '</a></div>';
}
function trv_title_podcast_title_nolink() {
	echo '<div class="item title link podcast_title">' . get_post_meta( get_the_ID(), "podcast_title", TRUE ) . '</div>';
}


/**
 * EMBED - PODCAST
 * 
 */

function trv_editor_podcast_embed() {
	$podcast_embed = get_post_meta( get_the_ID(), "podcast_embed", TRUE );
	echo '<div class="item podcast-embed">'.$podcast_embed.'</div>';
}
function trv_editor_podcast_embed_cta() {
	echo '<div class="item link podcast-link podcast-embed-cta"><a href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">Listen Now</a></div>';
}


/**
 * CTA - PODCAST
 * 
 */

function trv_cta_podcast() {
	echo '<a class="item cta link podcast" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">View Full Podcast Page</a>';
}


/**
 * LINK - PODCAST
 * 
 */

function trv_link_podcast_link() {
	$podcast_link = get_post_meta( get_the_ID(), "podcast_link", TRUE );
	echo '<span class="item link podcast-link"><a href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">View Full Detail</a></span>';
}
function trv_link_podcast_link_apple() {
	$podcast_link_apple = get_post_meta( get_the_ID(), "podcast_link_apple", TRUE );
	echo '<span class="item link podcast-link podcast-link-apple">&nbsp;&nbsp;|&nbsp;&nbsp;Listen on <a href="' . $podcast_link_apple . '" tabindex="-1" aria-hidden="true">Apple Podcasts</a>';
}
function trv_link_podcast_link_spotify() {
	$podcast_link_spotify = get_post_meta( get_the_ID(), "podcast_link_spotify", TRUE );
	echo '<span class="item link podcast-link podcast-link-spotify">&nbsp;&nbsp;|&nbsp;&nbsp;Listen on <a href="' . $podcast_link_spotify . '" tabindex="-1" aria-hidden="true">Spotify</a>';
}