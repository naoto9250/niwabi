<?php
/**
 * Partial template for slider in page.php
 *
 * @package understrap
 */
?>

<div class="top-herder" style="background-image: url(<?php echo get_the_topimage_url(); ?>);">

	<div class="top-logo">
		<a href="<?php echo home_url() ?>">
			<img src="<?php echo get_the_logo_img_url(); ?>" alt="木江宿 庭火" />
		</a>
	</div>

</div><!-- .top-slider -->

<!-- ******************* The Navbar Area ******************* -->
<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

	<nav class="navbar navbar-expand-md navbar-dark">

	<?php if ( 'container' == $container ) : ?>
		<div class="container" >
	<?php endif; ?>

		<!-- <div class="language">
			<span><a href="https://niwabi-hostel.jp/">Japanese</a></span>
			<span> / </span>
			<span><a href="https://niwabi-hostel.jp/en/">English</a></span>
		</div> -->

		<button id="nav-slide" class="navbar-toggler navToggle" type="button" data-toggle="collapse" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
			<span></span><span></span><span></span><span>menu</span>
		</button>

		<!-- The WordPress Menu goes here -->
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'navbar-slide collapse navbar-collapse',
				'container_id'    => 'navbarNavSlide',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		); ?>
	<?php if ( 'container' == $container ) : ?>
	</div><!-- .container -->
	<?php endif; ?>

	</nav><!-- .site-navigation -->

</div><!-- #wrapper-navbar end -->

