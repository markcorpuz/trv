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

	// FEATURED IMAGE
	setup_be_image();
	//setup_be_image_nolink();

	echo '<div class="items info">';

		// OVERLINE
		setup_be_overline();
		//setup_be_overline_nolink();
		
		// TITLE
		setup_be_title();
		//setup_be_title_nolink();

		// AUTHOR
		//setup_be_author_name();
		//setup_be_author_by_name();
		//setup_be_author_gravatar_by_name();
		//setup_be_author_gravatar();
		
		// DATE
		//setup_be_date_mdy();
		//setup_be_date_weekday_mdy();

		// DATE & AUTHOR
		setup_be_date_vbar_author_name();
		//setup_be_date_by_author_name();

		// EXCERPT
		setup_be_excerpt();
		//setup_be_excerpt_maxwords();

	echo '</div>';

echo '</article>';