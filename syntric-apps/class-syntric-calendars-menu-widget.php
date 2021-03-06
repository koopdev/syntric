<?php

	/**
	 * Syntric_Calendars_Menu_Widget
	 */
	class Syntric_Calendars_Menu_Widget extends WP_Widget {
		/**
		 * Set up a new widget instance
		 */
		public function __construct() {
			$widget_ops = [
				'classname'                   => 'syn-calendars-menu-widget',
				'description'                 => __( 'Displays a list of calendars.' ),
				'customize_selective_refresh' => true,
			];
			parent::__construct( 'syn-calendars-menu-widget', __( 'Calendars Menu' ), $widget_ops );
			$this->alt_option_name = 'syn-calendars-menu-widget';
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
			$all_calendars = get_field( 'syn_calendars_menu_widget_all_calendars', 'widget_' . $args[ 'widget_id' ] );
			if ( $all_calendars ) {
				$calendars = syn_get_calendars();
			} else {
				$calendars = get_field( 'syn_calendars_menu_widget_calendars', 'widget_' . $args[ 'widget_id' ] );
			}
			$lb  = syn_get_linebreak();
			$tab = syn_get_tab();
			//$sidebar = syn_widget_sidebar( $args[ 'widget_id' ] );
			$sidebar_class = syn_get_sidebar_class( $args[ 'widget_id' ] );
			$title         = get_field( 'syn_calendars_menu_widget_title', 'widget_' . $args[ 'widget_id' ] );
			echo $args[ 'before_widget' ] . $lb;
			if ( ! empty( $title ) ) :
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ] . $lb;
			endif;
			echo '<div class="list-group ' . $sidebar_class . '">' . $lb;
			if ( $calendars ) :
				$ref_date = ( isset( $_GET[ 'ref_date' ] ) ) ? $_GET[ 'ref_date' ] : date( 'Ymd' );
				foreach ( $calendars as $calendar ) {
					echo $tab . $tab . '<a href="' . get_the_permalink( $calendar->ID ) . '?ref_date=' . $ref_date . '" data-id="' . $calendar->ID . '" class="list-group-item list-group-item-action">';
					echo $tab . $tab . $tab . $calendar->post_title . $lb;
					echo '</a>' . $lb;
				};
			else :
				echo $tab . $tab . '<div class="list-group-item">No calendars</div>' . $lb;
			endif;
			echo '</div>' . $lb;
			echo $args[ 'after_widget' ] . $lb;
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
