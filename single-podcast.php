<?php
/**
 * Single Post
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Entry category in header
//add_action( 'genesis_entry_header', 'ea_entry_category', 8 );
//add_action( 'genesis_entry_header', 'ea_entry_author', 12 );
//add_action( 'genesis_entry_header', 'ea_entry_header_share', 13 );

/**
 * Entry header share
 *
 */
function ea_entry_header_share() {
    do_action( 'ea_entry_header_share' );
}

/**
 * After Entry
 *
 */
/*function ea_single_after_entry() {
    echo '<div class="after-entry">';

    // Breadcrumbs
    genesis_do_breadcrumbs();

    // Publish date
    echo '<p class="publish-date">Published on ' . get_the_date( 'F j, Y' ) . '</p>';

    // Sharing
    do_action( 'ea_entry_footer_share' );

    // Author Box
    genesis_do_author_box_single();
}
add_action( 'genesis_after_entry', 'ea_single_after_entry', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
*/

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

/**
 * TRV: Entry Content
 * 
 */
function trv_single_podcast_entry_content() {

    echo '<section class="post-summary module podcast">';
        
        // NATIVE | ID
        $pid = get_the_ID();

        $date_published = get_the_date( 'M d Y', $pid );

        if( $date_published ) {

            // NATIVE | DATE PUBLISHED
            $dp_array[] = '<span class="item date">'.$date_published.'</span>';

            // CUSTOM | Podcast Season
            $podcast_season = get_post_meta( $pid, "podcast_season", TRUE );
            if( $podcast_season ) {
                $dp_array[] = '<span class="item season">Season '.get_term( $podcast_season )->name.'</span>';
            }
            
            // CUSTOM | Podcast Episode
            $podcast_episode = get_post_meta( $pid, "podcast_episode", TRUE );
            if( $podcast_episode ) {
                $dp_array[] = '<span class="item episode">Episode '.$podcast_episode.'</span>';
            }

            // set content with dividers
            echo '<div class="items meta">'.setup_starter_add_divider( "|", $dp_array ).'</div>';

        }

        // validate image to be used
        $podcast_pic = get_post_meta( $pid, "podcast_pic", TRUE );

        if( $podcast_pic ) {

            // set display image
            $display_this_image = '<div class="item pic">'.wp_get_attachment_image( $podcast_pic, 'medium' ).'</div>';

            // empty the variable
            $no_podcast_pic = '';

        } else {

            // no display image | empty the variable
            $display_this_image = '';

            // no display image | set selector
            $no_podcast_pic = ' no-podcast-pic';

        }

        echo '<div class="items input'.$no_podcast_pic.'">';

            // CUSTOM | Podcast Pic
            
            echo $display_this_image;

            echo '<div class="items info">';

                // CUSTOM | Podcast Title
                $podcast_title = get_post_meta( $pid, "podcast_title", TRUE );
                if( $podcast_title ) {
                    echo '<div class="item title">'.$podcast_title.'</div>';
                    echo '<div class="item cta"><a class="item ctalink" href="https://dev.travisalbritton.local/podcast/">LIST ALL PODCASTS</a></div>';
                }

                // CUSTOM | Podcast Participants
                /*
                $pod_parti = get_post_meta( $pid, "podcast_participants", TRUE );
                if( $pod_parti ) {
                    
                    echo '<p><strong>Podcast Participants:</strong></p>';
                    
                    foreach( $pod_parti as $pod_val ) {
                        $term = get_term( $pod_val );
                        echo '<p>'.$term->name.'</p>';
                    }
                    
                } else {
                    //echo '<p>No Partipants included</p>';
                }
                */

                // NATIVE | EXCERPT
                $wp_native_excerpt = get_the_excerpt( $pid );
                if( $wp_native_excerpt ) {
                    echo '<div class="item excerpt">'.wp_strip_all_tags( $wp_native_excerpt, TRUE ).'</div>';
                }

                // CUSTOM | Podcast Embed
                $podcast_embed = get_post_meta( $pid, "podcast_embed", TRUE );
                if( $podcast_embed ) {
                    echo '<div class="items proxy">
                            <div class="item podcast-embed">'.$podcast_embed.'</div>
                          </div>';
                }

                // CUSTOM | Podcast Link Apple
                $podcast_link_apple = get_post_meta( $pid, "podcast_link_apple", TRUE );
                if( $podcast_link_apple ) {
                    $podcast_links[] = '<span class="item cta">Listen on </span><span class="item cta apple"><a class="item ctalink apple" href="'.$podcast_link_apple.'">APPLE PODCASTS</a> </span>';
                }

                // CUSTOM | Podcast Link Spotify
                $podcast_link_spotify = get_post_meta( $pid, "podcast_link_spotify", TRUE );
                if( $podcast_link_spotify ) {
                    $podcast_links[] = '<span class="item cta">Listen on </span><span class="item cta spotify"><a class="item ctalink spotify" href="'.$podcast_link_spotify.'">SPOTIFY</a> </span>';
                }

                if( $podcast_links ) {
                    echo '<div class="items cta">'.setup_starter_add_divider( '|', $podcast_links ).'</div>';
                }

            echo '</div>';

        echo '</div>';
        
        
    echo '</section>';

}
add_action( 'genesis_entry_header', 'trv_single_podcast_entry_content', 100 );


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