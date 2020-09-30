<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<header class="entry-header page-header">

		<?php get_template_part( 'original-templates/page', 'header' ); ?>

	</header><!-- .entry-header -->

	<img src="<?php echo get_the_attendimage_url(); ?>" alt="attend" class="section-img">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main ea-main" id="main" role="main">

					<?php get_template_part( 'loop-templates/content', 'attend' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_template_part( 'sidebar-templates/sidebar', 'right-attend' ); ?>

		</div><!-- .row -->

		<?php echo do_shortcode('[contact-form-7 id="156" title="event-attend-form"]'); ?>

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
