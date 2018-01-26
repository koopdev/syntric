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
			if( 1 != $active ) {
				return;
			}
			if( ! isset( $args[ 'widget_id' ] ) ) {
				$args[ 'widget_id' ] = $this->id;
			}
			$category  = get_field( 'syn_microblog_category', $post->ID );
			$term      = get_field( 'syn_microblog_term', $post->ID );
			$number    = get_field( 'syn_microblog_posts', $post->ID );
			$posts     = new WP_Query( apply_filters( 'widget_posts_args', [
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
						[
							'taxonomy' => 'microblog',
							'field'    => 'ID',
							'terms'    => [ $term->term_id ],
						],
					],
				] )
			);
			if ( syn_remove_whitespace() ) {
				$lb  = '';
				$tab = '';
			} else {
				$lb  = "\n";
				$tab = "\t";
			}
			$sidebar   = syn_widget_sidebar( $args[ 'widget_id' ] );
			//slog( $sidebar );
			$title     = get_field( 'syn_microblog_title', $post->ID );
			$show_date = get_field( 'syn_microblog_include_date', $post->ID );
			echo $args[ 'before_widget' ] . $lb;
			if( ! empty( $title ) ) :
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ] . $lb;
			endif;
			if( $posts->have_posts() ) :
				echo '<div class="list-group ' . $sidebar['section']['value'] . '">' . $lb;
				while( $posts->have_posts() ) : $posts->the_post();
					echo $tab . '<a href="' . get_the_permalink() . '" class="list-group-item">' . $lb;
					echo $tab . $tab . '<div class="post-title">' . get_the_title() . '</div>';
					if( $show_date ) :
						echo $tab . $tab . '<div class="post-date small">' . get_the_date() . '</div>';
					endif;
					echo $tab . '</a>';
				endwhile;
				echo $tab . '<a href="' . get_term_link( $term->term_id ) . '" class="list-group-item more-link">Go to blog</a>' . $lb;
				echo '</div>' . $lb;
			else :
				echo $tab . '<p>No posts</p>' . $lb;
			endif;
			echo $args[ 'after_widget' ] . $lb;
			wp_reset_postdata();
			wp_reset_query();
			if( is_user_logged_in() && ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) || $post->post_author == get_current_user_id() ) ) {
				// this is for a New Post button
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
