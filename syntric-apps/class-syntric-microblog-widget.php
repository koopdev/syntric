<?php

	/**
	 * Syntric_Microblog_Widget
	 */
	class Syntric_Microblog_Widget extends WP_Widget {
		/**
		 * Set up a new widget instance
		 */
		public function __construct() {
			$widget_ops = [
				'classname'                   => 'syn-microblog-widget',
				'description'                 => __( 'Displays microblog posts on pages where "Microblog" is enabled.' ),
				'customize_selective_refresh' => true,
			];
			parent::__construct( 'syn-microblog-widget', __( 'Microblog' ), $widget_ops );
			$this->alt_option_name = 'syn-microblog-widget';
		}

		/**
		 * Output widget content
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			global $post;
			$active = get_field( 'syn_microblog_active', $post->ID );
			if ( 1 != $active ) {
				return;
			}
			if ( ! isset( $args[ 'widget_id' ] ) ) {
				$args[ 'widget_id' ] = $this->id;
			}
			//$category = get_field( 'syn_microblog_category', $post->ID );
			//$term     = get_field( 'syn_microblog_term', $post->ID );
			$terms = get_terms( [
				'taxonomy'   => 'category',
				'meta_key'   => 'syn_category_page',
				'meta_value' => $post->ID,
			] );
			if ( count( $terms ) ) {
				$category_ids = [];
				$number       = get_field( 'syn_microblog_posts', $post->ID );
				foreach ( $terms as $term ) {
					$category_ids[] = $term->term_id;
				}
				//slog( implode( ',', $category_ids ) );
				$microblog_posts = get_posts( [
					'numberposts' => $number,
					'post_type'   => 'post',
					'category'    => implode( ',', $category_ids ),
					//'no_found_rows'       => true,
					'post_status' => 'publish',
				] );
				//slog( $microblog_posts );
				//slog( $terms );
				/*'ignore_sticky_posts' => true,
				'tax_query'           => [
					[
						'taxonomy' => 'category',
						'field'    => 'ID',
						'terms'    => $category_ids,
					],
				],*/
				/*$number   = get_field( 'syn_microblog_posts', $post->ID );
				$posts    = new WP_Query( apply_filters( 'widget_posts_args', [
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'tax_query'           => [
						'relation' => 'AND',
						[
							'taxonomy' => 'category',
							'field'    => 'ID',
							'terms'    => [ $category->term_id ],
						],
						//[
							//'taxonomy' => 'microblog',
							//'field'    => 'ID',
							//'terms'    => [ $term->term_id ],
						//],
					],
				] ) );*/
				$lb  = syn_get_linebreak();
				$tab = syn_get_tab();
				//$sidebar       = syn_widget_sidebar( $args[ 'widget_id' ] );
				//$sidebar[ 'section' ][ 'value' ]
				$sidebar_class = syn_get_sidebar_class( $args[ 'widget_id' ] );
				$title         = get_field( 'syn_microblog_title', $post->ID );
				$show_date     = get_field( 'syn_microblog_include_date', $post->ID );
				echo $args[ 'before_widget' ] . $lb;
				if ( ! empty( $title ) ) :
					echo $args[ 'before_title' ] . $title . $args[ 'after_title' ] . $lb;
				endif;
				echo '<div class="list-group ' . $sidebar_class . '">' . $lb;
				if ( count( $microblog_posts ) ) :
					foreach ( $microblog_posts as $microblog_post ) {
						echo $tab . '<a href="' . get_the_permalink( $microblog_post->ID ) . '" class="list-group-item">' . $lb;
						echo $tab . $tab . '<div class="post-title">' . get_the_title( $microblog_post->ID ) . '</div>';
						if ( $show_date ) :
							echo $tab . $tab . '<div class="post-date small">' . get_the_date( $microblog_post->ID ) . '</div>';
						endif;
						echo $tab . '</a>';
					}
					echo $tab . '<a href="' . get_term_link( $term->term_id ) . '" class="list-group-item list-group-item-action more-link">Go to blog</a>' . $lb;
				else :
					echo $tab . '<div class="list-group-item">No posts</div>' . $lb;
				endif;
				echo '</div>' . $lb;
				echo $args[ 'after_widget' ] . $lb;
				//wp_reset_postdata();
				//wp_reset_query();
				if ( is_user_logged_in() && ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || $post->post_author == get_current_user_id() ) ) {
					// this is for a New Post button
				}
			}
		}

		/**
		 * Update settings for the current widget instance
		 *
		 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
		 * @param array $old_instance Old settings for this instance.
		 *
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			return $instance;
		}

		/**
		 * Render settings form for the widget
		 *
		 * @param array $instance Current settings
		 *
		 * @return void Displays settings form
		 */
		public function form( $instance ) { }
	}
