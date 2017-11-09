<?php get_header(); ?>
<div id="home-wrapper" class="content-wrapper">
	<div class="<?php echo esc_html( get_theme_mod( 'syntric_container_type' ) ); ?>">
		<div class="row">
			<?php syn_get_sidebars( 'main', 'left' ); ?>
			<main id="content" class="col content-area">
				<header class="page-header">
					<h1 class="page-title">
						<?php echo get_the_title( get_option( 'page_for_posts' ) ); ?>
					</h1>
				</header>
				<?php
				syn_get_sidebars( 'main', 'top' );
				if ( have_posts() ) {
					while ( have_posts() ) : the_post();
						get_template_part( 'loop-templates/content', 'excerpt' );
					endwhile;
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				syn_pagination();
				syn_get_sidebars( 'main', 'bottom' );
				?>
			</main>
			<?php syn_get_sidebars( 'main', 'right' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
