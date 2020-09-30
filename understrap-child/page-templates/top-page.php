<?php
/**
 * Template Name: Top Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<header class="entry-header page-header">

		<?php get_template_part( 'original-templates/top', 'header' ); ?>

	</header><!-- .entry-header -->

	<?php get_template_part( 'original-templates/top', 'concept' ); ?>

	<?php get_template_part( 'original-templates/top', 'room' ); ?>

	<?php get_template_part( 'original-templates/top', 'event' ); ?>

	<?php get_template_part( 'original-templates/top', 'attend' ); ?>

	<?php get_template_part( 'original-templates/top', 'access' ); ?>

	<?php get_template_part( 'original-templates/top', 'booking' ); ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>
