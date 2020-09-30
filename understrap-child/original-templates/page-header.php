<?php
/**
 * Partial template for slider in page.php
 *
 * @package understrap
 */
?>

<!-- ******************* The Navbar Area ******************* -->
<div id="wrapper-navbar" class="page-navbar" itemscope itemtype="http://schema.org/WebSite">

	<a href="<?php echo home_url() ?>">
		<img src="<?php echo get_the_pagelogo_img_url(); ?>" alt="木江宿 庭火" class="pagelogo-img">
	</a>

	<nav class="navbar navbar-expand-md navbar-dark">

	<?php if ( 'container' == $container ) : ?>
		<div class="container" >
	<?php endif; ?>

		<!-- <div class="language">
			<span><a href="https://niwabi-hostel.jp/">Japanese</a></span>
			<span> / </span>
			<span><a href="https://niwabi-hostel.jp/en/">English</a></span>
		</div> -->

		<button class="navbar-toggler navToggle" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
			<span></span><span></span><span></span><span>menu</span>
		</button>
		
		<!-- The WordPress Menu goes here -->
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
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

