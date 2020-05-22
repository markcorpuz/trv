<?php
/**
 * Archive partial
 *
 * @package      SETUP-BE
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="module post-summary">';

	setup_be_post_summary_image();

	echo '<div class="items info post-summary__content">';
		setup_be_overline();
		setup_be_post_summary_title();
		//ea_entry_author();
		//setup_be_author_name();
		//setup_be_date_published();
		setup_be_date_published_author();
		//setup_be_excerpt();
		setup_be_excerpt_only();
	echo '</div>';

echo '</article>';