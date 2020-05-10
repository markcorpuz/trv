<?php
/**
 * Taxonomy Archive partial
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="post-summary">';
    echo '<h5>Taxonomy Archive file in Partial folder</h5>';
	ea_post_summary_image();

	echo '<div class="post-summary__content">';
		ea_entry_category();
		ea_post_summary_title();
	echo '</div>';
    
echo '</article>';
