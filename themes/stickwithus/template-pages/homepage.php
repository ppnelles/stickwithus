<?php
/**
 * Template Name: homepage
 *
 * @package _turbo
 */

get_header();
?>

<main id="primary" class="site-main" role="main" itemprop="mainContentOfPage">

	<section id="stick">
		<figure class="background">
			<img src="<?php bloginfo('template_directory'); ?>/img/header-background.jpg">
		</figure>
		<figure class="logo">
			<img src="<?php bloginfo('template_directory'); ?>/img/stickwithus-logo.svg">
		</figure>

		<div class="accroche">
			<a href="#participer"><span>Let's</span><b>Go</b></a>
		</div>
	</section>

	<section id="introduction">
		<div class="inner">
			<div class="title">
				<?php the_field( 'int_title' ); ?>
			</div>
			<div class="content">
				<?php the_field( 'int_content' ); ?>
			</div>
		</div>
	</section>

	<section id="sponsors">
		<div class="content">
			<h2><?php the_field( 'spo_title' ); ?></h2>
			<div class="text"><?php the_field( 'spo_content' ); ?></div>
			<div class="cta">
				<button class="form-btn btn">Participer</button>
			</div>
		</div>
		<?php //ACF field must be set as ID
			if(get_field('spo_image')) { ?>
				<figure>
					<?php echo wp_get_attachment_image(get_field('spo_image'), 'full'); ?>
				</figure>
		<?php } ?>
	</section>

	<section id="supporters">
		<div class="inner">
			<div class="content">
				<h2><?php the_field( 'sup_title' ); ?></h2>
				<div class="text"><?php the_field( 'sup_content' ); ?></div>
				<div class="cta">
					<button class="form-btn btn">Participer</button>
				</div>
			</div>
			<?php //ACF field must be set as ID
				if(get_field('sup_image')) { ?>
					<figure>
						<?php echo wp_get_attachment_image(get_field('sup_image'), 'full'); ?>
					</figure>
			<?php } ?>
		</div>
	</section>

	<section id="participer">
		<div class="inner">
			<div class="all-slides">
				<div class="slide" id="slide-intro">
					<h2><span>Je souhaite</span> <span>participer :</span></h2>
					<ul class="type-selector">
						<li><button class="slide-next" data-type="sponsor">Je veux devenir sponsor</button></li>
						<li><button class="slide-next" data-type="supporter">Je veux devenir supporter</button></li>
					</ul>
				</div>
				<div class="slide" id="slide-choice">
					<div class="slide-sponsor-choice">
						<h2><span>Je choisis</span> <span>mon engagement :</span></h2>

						<ul class="sponsor-choice">
							<li>
								<button class="slide-next" data-formula="bache-1">Bâches</button>
								<button class="slide-next" data-formula="bache-2">Bâches</button>
								<button class="slide-next" data-formula="bache-3">Bâches</button>
								<button class="slide-next" data-formula="mousses">Mousses</button>
								<button class="slide-next" data-formula="jetons">Jetons</button>
								<button class="slide-next" data-formula="...">...</button>
							</li>
						</ul>
						<div class="cta">
							<button class="slide-prev">Retour</button>
						</div>
					</div>
					<div class="slide-supporter-choice">
						<h2><span>Je choisis</span> <span>mon engagement :</span></h2>

						<ul class="supporter-choice">
							<li>
								<button class="slide-next" data-formula="arbres">Arbre</button>
								<button class="slide-next" data-formula="balles">Balles</button>
								<button class="slide-next" data-formula="sur-mesure">Formules sur mesure</button>
							</li>
						</ul>
						<div class="cta">
							<button class="slide-prev">Retour</button>
						</div>
						
					</div>
				</div>
				<div class="slide" id="slide-form">
					<h2><span>Je complète</span> <span>mes données :</span></h2>
					<input type="text" class="contact-type" name="type" value="">
					<input type="text" class="selected-formula" name="selected" value="">
					<div class="cta">
						<button class="slide-prev">Retour</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="exit">
		<?php //ACF field must be set as ID
		if(get_field('exi_image')) { ?>
			<figure>
				<?php echo wp_get_attachment_image(get_field('exi_image'), 'full'); ?>
			</figure>
		<?php } ?>
	</section>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();