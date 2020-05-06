<?php
/**
 * Archive partial - PODCAST
 *
 * @package      EAGenesisChild
 * @author       Jake Almeda
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="post-summary module podcast">';
    
    // NATIVE | ID
    $pid = get_the_ID();

    $date_published = get_the_date( 'M d Y', $pid );

    if( $date_published ) {

        echo '<div class="items meta">';

            // NATIVE | DATE PUBLISHED
            echo '<span class="item date">'.$date_published.'</span>';

            // CUSTOM | Podcast Season
            $podcast_season = get_post_meta( $pid, "podcast_season", TRUE );
            if( $podcast_season ) {
                echo ' | <span class="item season">Season <a href="'.get_term_link( get_term( $podcast_season )->term_id ).'"> '.get_term( $podcast_season )->name.'</a></span>';
            }
            
            // CUSTOM | Podcast Episode
            $podcast_episode = get_post_meta( $pid, "podcast_episode", TRUE );
            if( $podcast_episode ) {
                echo ' | <span class="item episode">Episode '.$podcast_episode.'</span>';
            }

        echo '</div>';

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
                echo '<div class="item title"><a class="item titlelink" href="'.get_the_permalink( $pid ).'">'.$podcast_title.'</a></div>';
                echo '<div class="item cta"><a class="item ctalink" href="'.get_the_permalink( $pid ).'">VIEW FULL PODCAST PAGE</a></div>';
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
            if( get_the_excerpt( $pid ) ) {
                echo '<div class="item excerpt">'.wp_strip_all_tags( get_the_excerpt( $pid ), TRUE ).'</div>';
            }

            echo '<div class="items proxy">';

                // CUSTOM | Podcast Embed
                $podcast_embed = get_post_meta( $pid, "podcast_embed", TRUE );
                if( $podcast_embed ) {
                    echo '<div class="item podcast-embed">'.$podcast_embed.'</div>';
                }

            echo '</div>';

        echo '</div>';

    echo '</div>';
    
    
echo '</article>';
