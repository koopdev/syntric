<?php

	/**
	 * Syntric_Gallery_Widget
	 */
	class Syntric_Gallery_Widget extends WP_Widget {
		/**
		 * Set up a new widget instance
		 */
		public function __construct() {
			$widget_ops = [ 'classname'                   => 'syn-gallery-widget',
			                'description'                 => __( 'Displays a gallery of images' ),
			                'customize_selective_refresh' => true,
			];
			parent::__construct( 'syn-gallery-widget', __( 'Gallery' ), $widget_ops );
			$this->alt_option_name = 'syn-gallery-widget';
		}

		/**
		 * Output widget content
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			global $post;
			if ( ! isset( $args[ 'widget_id' ] ) ) {
				$args[ 'widget_id' ] = $this->id;
			}
			$dynamic = get_field( 'syn_gallery_widget_dynamic', 'widget_' . $args[ 'widget_id' ] );
			if ( $dynamic ) {
				$active = get_field( 'syn_gallery_active', $post->ID );
				if ( ! $active ) {
					return;
				}
				$title   = get_field( 'syn_gallery_title', $post->ID );
				$gallery = get_field( 'syn_gallery_gallery', $post->ID );
				/*$caption = get_field( 'syn_gallery_caption', $post->ID );
				$type    = strtolower( get_field( 'syn_gallery_type', $post->ID ) );
				$host    = strtolower( get_field( 'syn_gallery_host', $post->ID ) );
				if ( 'single' == $type ) {
					$video_id = ( 'youtube' == $host ) ? get_field( 'syn_gallery_youtube_id', $post->ID ) : get_field( 'syn_gallery_vimeo_id', $post->ID );
				} elseif ( 'youtube' == $host && 'playlist' == $type ) {
					$video_id = ( 'youtube' == $host ) ? get_field( 'syn_gallery_youtube_playlist_id', $post->ID ) : 0;
				}*/
			} else {
				$title   = get_field( 'syn_gallery_widget_title', 'widget_' . $args[ 'widget_id' ] );
				$gallery = get_field( 'syn_gallery_widget_gallery', 'widget_' . $args['widget_id' ] );
				/*$caption = get_field( 'syn_gallery_widget_caption', 'widget_' . $args[ 'widget_id' ] );
				$type    = strtolower( get_field( 'syn_gallery_widget_type', 'widget_' . $args[ 'widget_id' ] ) );
				$host    = strtolower( get_field( 'syn_gallery_widget_host', 'widget_' . $args[ 'widget_id' ] ) );
				if ( 'single' == $type ) {
					$video_id = ( 'youtube' == $host ) ? get_field( 'syn_gallery_widget_youtube_id', $post->ID ) : get_field( 'syn_gallery_widget_vimeo_id', $post->ID );
				} elseif ( 'youtube' == $host && 'playlist' == $type ) {
					$video_id = ( 'youtube' == $host ) ? get_field( 'syn_gallery_widget_youtube_playlist_id', $post->ID ) : 0;
				}*/
			}
			if ( $gallery ) :
				//slog($gallery);
				/**
				 *
				 *
				 *
				 *
				 * Abandoned temporarily in favor of Media Folder galleries which include a light box and other goodies.
				 *
				 *
				 *
				 *
				 *
				 *
				 */
				/*if ( 'youtube' == $host ) {
					if ( 'single' == $type ) {
						$iframe = '<iframe id="youtube-player-' . $video_id . '" class="embed-responsive-item" src="https://www.youtube.com/embed/' . $video_id . '?rel=0&controls=1&showinfo=0&enablejsapi=1" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen=""></iframe>';
					} elseif ( 'playlist' == $type ) {
						$iframe = '<iframe id="youtube-player-' . $video_id . '" class="embed-responsive-item" src="https://www.youtube.com/embed/videoseries?list=' . $video_id . '&enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
					}
				} elseif ( 'vimeo' == $host ) {
					$iframe = '<iframe id="vimeo-player-' . $video_id . '" class="embed-responsive-item" src="https://player.vimeo.com/video/' . $video_id . '?title=0&byline=0&portrait=0" frameborder="0" allowfullscreen></iframe>';
				}*/
				//$sidebar      = syn_widget_sidebar( $args[ 'widget_id' ] );
				$sidebar_class = syn_get_sidebar_class( $args[ 'widget_id' ] );
				$lb            = syn_get_linebreak();
				$tab           = syn_get_tab();
				echo $args[ 'before_widget' ] . $lb;
				if ( ! empty( $title ) ) :
					echo $args[ 'before_title' ] . $title . $args[ 'after_title' ] . $lb;
				endif;
				/*echo '<div class="video ' . $sidebar_class . ' ' . strtolower( $host ) . ' embed-responsive embed-responsive-16by9">' . $lb;
				echo $iframe;
				echo '</div>' . $lb;
				if ( $caption && ! empty( $caption ) ) {
					echo '<div class="video-caption">' . $lb;
					echo $caption;
					echo '</div>' . $lb;
				}*/
				echo '<div class="gallery">';
				foreach ( $gallery as $image ) {
					echo '<figure class="gallery-item">';
					echo '';
					echo '</figure>';
				}
				echo '</div>';
				echo $args[ 'after_widget' ] . $lb;
			endif;
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