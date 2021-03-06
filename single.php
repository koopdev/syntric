<?php
	get_header();
	$lb  = syn_get_linebreak();
	$tab = syn_get_tab();
	echo '<div id="single-wrapper" class="content-wrapper ' . get_post_type() . '-wrapper">';
	echo '<div class="' . esc_html( get_theme_mod( 'syntric_container_type' ) ) . '">';
	echo '<div class="row">';
	syn_sidebar( 'main', 'left' );
	echo '<main id="content" class="col content-area content">';
	echo '<h1 class="page-title" role="heading">' . get_the_title() . syn_get_post_badges() . '</h1>';
	syn_sidebar( 'main', 'top' );
	if ( have_posts() ) {
		while( have_posts() ) : the_post();
			if ( 'syn_calendar' == get_post_type() ) :
				echo '<div id="fullcalendar">';
				echo '<span>Calendar is loading</span>';
				echo '</div>';
			elseif ( 'syn_event' == get_post_type() ) :
				$dates    = syn_get_event_dates( get_the_ID() );
				$location = get_field( 'syn_event_location', get_the_ID() );
				echo '<article class="' . implode( ' ', get_post_class() ) . '" id="post-' . $post->ID . '">' . $lb;
				//echo '<header class="post-header">';
				echo '<span class="post-date">' . $dates . '</span>';
				if ( ! empty( $location ) ) :
					echo '<span class="post-location">' . $location . '</span>';
				endif;
				//echo '</header>';
				echo '<div class="post-content">';
	//the_content();
				echo '</div>';
				echo '</article>';
	/**/
?><!--
				<script type="text/javascript">
					var postContent = anchorme('<?php /*the_content(); */
?>');
					$('.post-content').html(postContent);
				</script>
			--><?php
	else :
	echo '<article class="' . implode( ' ', get_post_class() ) . '" id="post-' . $post->ID . '">' . $lb;
	//echo '<header class="post-header">';
	echo '<span class="post-date">' . get_the_date() . '</span>';
	//echo '</header>';
	echo '<div id="-post-content" class="post-content">';
	//the_content();
	echo '</div>';
	echo '</article>';
	/**/
?><!--
				<script type="text/javascript">
					(function ($) {
						var pre = $('#-post-content');
						var pre_text = pre.text();
						var post_text = anchorme(pre_text);
						console.log(post_text);
						pre.append(post_text);
					})(jQuery);
				</script>
			--><?php
			endif;
		endwhile;
	} else {
		get_template_part( 'loop-templates/content', 'none' );
	}
	syn_sidebar( 'main', 'bottom' );
	echo '</main>';
	syn_sidebar( 'main', 'right' );
	echo '</div>';
	echo '</div>';
	echo '</div>';
	get_footer();
?>