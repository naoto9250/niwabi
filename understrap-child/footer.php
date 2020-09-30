<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="footer-info">

	<a href="<?php echo home_url() ?>">

		<img src="<?php echo get_the_footerlogo_url(); ?>" alt="footerlogo" class="footer-logo">

	</a>

	<div class="footer-text">
	
		<div class="ft-jp">

			<p><?php echo get_option('footer_adress'); ?></p>

			<p><?php echo get_option('footer_tel'); ?></p>

			<p><?php echo get_option('footer_email'); ?></p>

		</div><!-- ft-jp end -->

		<div class="ft-en">

			<p><?php echo get_option('footer_adress_en'); ?></p>

			<p><?php echo get_option('footer_tel_en'); ?></p>

		</div><!-- ft-en end -->

		<div class="ft-sns">

			<a href="<?php echo get_option('facebook_link'); ?>">

				<img src="<?php echo get_the_facebookicon_url(); ?>" alt="facebook" class="sns-icon">

			</a>

			<a href="<?php echo get_option('insta_link'); ?>">

				<img src="<?php echo get_the_instaicon_url(); ?>" alt="instagram" class="sns-icon">

			</a>

		</div><!-- ft-sns end -->

	</div><!-- footer-text end -->

	<div class="clear"></div>

</div><!-- footer-info end -->

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<p><?php echo get_option('copyright'); ?></p>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<div class="i-amphtml-sidebar-mask" hidden=""></div>

<?php wp_footer(); ?>

</body>

</html>

