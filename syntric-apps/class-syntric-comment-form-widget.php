<?php

/**
 * Syntric_Comments_Form_Widget
 */
class Syntric_Comments_Form_Widget extends WP_Widget {
	/**
	 * Set up a new widget instance
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'syn-comments-form-widget',
			'description'                 => __( 'Displays comments form.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'syn-comments-form-widget', __( 'Comments Form' ), $widget_ops );
		$this->alt_option_name = 'syn-comments-form-widget';
	}

	/**
	 * Output widget content
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {
		global $post;
		$enabled = get_field( 'syn_enable_comments_form', $post->ID );
		if ( 1 != $enabled ) {
			return;
		}
		if ( ! isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		}
		$number        = get_field( 'syn_comments_form_post_count', $post->ID );
		$comments_form = get_field( 'syn_comments_form', $post->ID );
		$posts         = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'comments_form',
					'terms'    => $comments_form,
				),
			),
		) ) );
		if ( $posts->have_posts() ) :
			$lb           = "\n";
			$tab          = "\t";
			$sidebar      = syn_widget_sidebar( $args[ 'widget_id' ] );
			$title        = get_field( 'syn_comments_form_title', $post->ID );
			$show_date    = get_field( 'syn_comments_form_show_date', $post->ID );
			$menu_classes = 'widget-menu';
			$item_classes = 'widget-item';
			$link_classes = 'widget-link';
			/**
			 * todo: implement custom classes
			 * $apply_classes = get_field( 'syncomments_form_widget_apply_classes', 'option' );
			 * if ( $apply_classes ) {
			 * $custom_menu_classes = get_field( 'syn_comments_form_widget_menu_classes', 'option' );
			 * $custom_item_classes = get_field( 'syn_comments_form_widget_item_classes', 'option' );
			 * $custom_link_classes = get_field( 'syn_comments_form_widget_link_classes', 'option' );
			 * $menu_classes        .= ( $custom_menu_classes ) ? ' ' . $custom_menu_classes : '';
			 * $item_classes        .= ( $custom_item_classes ) ? ' ' . $custom_item_classes : '';
			 * $link_classes        .= ( $custom_link_classes ) ? ' ' . $custom_link_classes : '';
			 * }*/
			echo $args[ 'before_widget' ] . $lb;
			if ( ! empty( $title ) ) :
				echo $args[ 'before_title' ] . $title . $args[ 'after_title' ] . $lb;
			endif;
			echo '<ul class="' . $menu_classes . '">' . $lb;
			while ( $posts->have_posts() ) : $posts->the_post();
				echo $tab . '<li class="' . $item_classes . '">' . $lb;
				echo '<a href="' . get_the_permalink() . '" class="' . $link_classes . '">' . $lb;
				echo '<span class="post-title">' . get_the_title() . '</span>' . $lb;
				if ( $show_date ) :
					echo '<span class="post-date">' . get_the_date() . '</span>' . $lb;
				endif;
				echo '</a>' . $lb;
				echo '</li>' . $lb;
			endwhile;
			wp_reset_postdata();
			echo '</ul>' . $lb;
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
