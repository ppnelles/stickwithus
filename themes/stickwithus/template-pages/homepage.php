<?php
/**
 * Template Name: homepage
 *
 * @package _turbo
 */

get_header();
?>

<main id="primary" class="site-main" role="main" itemprop="mainContentOfPage">

	<section class="intro">
		<figure class="background">
			<img src="<?php bloginfo('template_directory'); ?>/img/header-background.jpg">
		</figure>
		<figure class="logo">
			<img src="<?php bloginfo('template_directory'); ?>/img/stickwithus-logo.svg">
		</figure>
	</section>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();