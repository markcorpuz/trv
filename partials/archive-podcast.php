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

        // NATIVE | DATE PUBLISHED
        $dp_array[] = '<span class="item date">'.$date_published.'</span>';

        // CUSTOM | Podcast Season
        $pod_seasons = get_the_terms( $pid, 'podcast_season' ); 
        if( is_array( $pod_seasons ) ) {
            foreach( $pod_seasons as $pod_season ) {
                $dp_array[] = '<span class="item season"><a href="'.get_term_link( $pod_season->term_id ).'">Season '.$pod_season->name.'</a></span>';
            }
        }
        
        // CUSTOM | Podcast Episode
        $podcast_episode = get_post_meta( $pid, "podcast_episode", TRUE );
        if( $podcast_episode ) {
            $dp_array[] = '<span class="item episode">Episode '.$podcast_episode.'</span>';
        }

        // DISPLAY CONTENT WITH CONTAINER
        echo '<div class="items meta">'.setup_starter_add_divider( "|", $dp_array ).'</div>';

    }

    // VALIDATE IMAGE TO BE USED
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
            $pod_parti = get_the_terms( $pid, 'participant' ); 
            if( $pod_parti ) {
                foreach( $pod_parti as $participant ) {
                    echo '<p><a href="'.get_term_link( $participant->term_id ).'">'.$participant->name.'</a></p>';
                }
            }

            // NATIVE | EXCERPT
            $this_excerpt = get_the_excerpt( $pid );
            if( $this_excerpt ) {
                echo '<div class="item excerpt">'.wp_strip_all_tags( $this_excerpt, TRUE ).'</div>';
            }

            // CUSTOM | Podcast Embed
            $podcast_embed = get_post_meta( $pid, "podcast_embed", TRUE );
            if( $podcast_embed ) {
                echo '<div class="items proxy">
                          <div class="item podcast-embed">'.$podcast_embed.'</div>
                      </div>';
            }

        echo '</div>';

    echo '</div>';
    
    
echo '</article>';
