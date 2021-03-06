<?php
	get_header();
	$lb = syn_get_linebreak();
	$tab = syn_get_tab();
	$results = $wp_query->found_posts;
	$results_label = ( 1 < $results ) ? ' results' : ' result';
	echo '<div id="search-wrapper" class="content-wrapper ' . get_post_type() . '-wrapper">' . $lb;
	echo '<div class="' . esc_html( get_theme_mod( 'syntric_container_type' ) ) . '">' . $lb;
	echo '<div class="row">' . $lb;
	echo '<main id="content" class="col content-area content">' . $lb;
	echo '<h1 class="page-title" role="heading">' . $lb;
	echo 'Search Results<span class="badge badge-pill badge-secondary">' . $results . $results_label . '</span>' . $lb;
	echo '</h1>' . $lb;
	if ( have_posts() ) {
		while( have_posts() ) : the_post();
			//echo '<article class="' . implode( ' ', get_post_class() ) . '" id="post-' . $post->ID . '">' . $lb;
			echo '<article id="post-' . $post->ID . '">' . $lb;
			echo '<h2 class="post-title">' . $lb;
			echo '<a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a>' . $lb;
			if ( 'post' == $post->post_type ) {
				echo syn_get_excerpt_badges( $post->ID );
			}
			echo '</h2>' . $lb;
			/*if ( 'post' == $post->post_type ) {
				echo '<span class="post-category">' . syn_get_taxonomies_terms() . '</span>' . $lb;
				echo '<span class="post-date">' . get_the_date() . '</span>' . $lb;
			}*/
			if ( syn_has_content( $post->post_content ) ) {
				echo '<div class="post-content">' . $lb;
				the_excerpt();
				echo '</div>' . $lb;
			}
			echo '</article>' . $lb;
		endwhile;
	} else {
		get_template_part( 'loop-templates/content', 'none' );
	}
	syn_pagination();
	echo '</main>' . $lb;
	echo '</div>' . $lb;
	echo '</div>' . $lb;
	echo '</div>' . $lb;
	get_footer();