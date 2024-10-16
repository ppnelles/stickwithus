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
						<li><button class="slide-next" data-type="Sponsor">Je veux devenir sponsor</button></li>
						<li><button class="slide-next" data-type="Supporter">Je veux devenir supporter</button></li>
					</ul>
				</div>
				<div class="slide" id="slide-choice">
					<div class="slide-sponsor-choice">
						<h2><span>Je choisis</span> <span>mon engagement :</span></h2>
						<div class="choice-intro">
							Tous les prix s’entendent HTVA par an et pour minimum 3 ans.<br>Réalisation et production du support à charge du club, sauf mention contraire.
						</div>

						<ul class="sponsor-choice">
							<li>
								<input type="checkbox" id="formula-bache1" name="formulas" value="2 bâches sur les longs côtés des 2 terrains">
								<label for="formula-bache1">
									<div class="picto"></div>
									<div class="choice-title"><span>2 bâches sur</span> <span>les longs côtés des</span> <span>2 terrains</span></div>
									<div class="choice-price">2.500 €</div>
									<div class="choice-description">Taille standard 250 x 90 / Couleur uniforme / Design & production via EHC</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-bache2" name="formulas" value="2 bâches sur le nouveau terrain">
								<label for="formula-bache2">
									<div class="picto"></div>
									<div class="choice-title"><span>2 bâches sur</span> <span>le nouveau terrain</span></div>
									<div class="choice-price">1.750 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-bache3" name="formulas" value="2 bâches sur l’ancien terrain">
								<label for="formula-bache3">
									<div class="picto"></div>
									<div class="choice-title"><span>2 bâches sur</span> <span>l’ancien terrain</span></div>
									<div class="choice-price">1.250 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-bache4" name="formulas" value="1 grande bâche derrière le goal">
								<label for="formula-bache4">
									<div class="picto"></div>
									<div class="choice-title"><span>1 grande bâche</span> <span>derrière le goal</span></div>
									<div class="choice-price">2.500 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-mousses" name="formulas" value="Mousses de protection dans les goals">
								<label for="formula-mousses">
									<div class="picto"></div>
									<div class="choice-title"><span>Mousses de protection</span> <span>dans les goals (6)</span></div>
									<div class="choice-price">2.000 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-jetons" name="formulas" value="Jetons boissons">
								<label for="formula-jetons">
									<div class="picto"></div>
									<div class="choice-title"><span>Jetons</span> <span>boissons</span></div>
									<div class="choice-price">2.000 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-gobelets" name="formulas" value="Gobelets">
								<label for="formula-gobelets">
									<div class="picto"></div>
									<div class="choice-title"><span>Un pack de</span> <span>Gobelets</span></div>
									<div class="choice-price">2.000 €</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-equipements" name="formulas" value="Équipements divers pour une équipe">
								<label for="formula-equipements">
									<div class="picto"></div>
									<div class="choice-title"><span>Équipements divers pour</span> <span>une équipe du club<sup>*</sup></span></div>
									<div class="choice-price">à partir de 500 €</div>
									<div class="choice-description">Équipements divers pour une équipe du club, de marque Reece via Ikiba<sup>*</sup> : fee de 500 € au club + achat & marquage des textiles à charge du sponsor.</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-100-balles" name="formulas" value="100 balles de hockey à personnaliser">
								<label for="formula-100-balles">
									<div class="picto"></div>
									<div class="choice-title"><span>100 balles de hockey</span> <span>à personnaliser<sup>*</sup></span></div>
									<div class="choice-price">à partir de 250 €</div>
									<div class="choice-description">-	100 balles de hockey, à commander et personnaliser via Ikiba<sup>*</sup> : fee de 250 € au club + achat & marquage des balles à charge du sponsor</div>
								</label>
							</li>
						</ul>
						<div class="disclaimer"><span><sup>*</sup> Ces deux dernières formules ne sont accessibles qu’aux sponsors qui participent déjà à une des formules précédentes,</span> <span>et sous réserve de non-concurrence avec l’un des « grands sponsors » du club.</span></div>
						<div class="cta">
							<div>
								<button class="slide-next valid-formula">Suivant</button>
							</div>
							<div class="slide-prev">⇽ Retour</div>
							<div class="error-msg">Vous devez sélectionner au moins une option.</div>
						</div>
					</div>
					<div class="slide-supporter-choice">
						<h2><span>Je choisis</span> <span>mon engagement :</span></h2>
						<div class="choice-intro">
							Contribution financière en one-shot.<br>Non soumis à la TVA.</div>

						<ul class="supporter-choice">
							<li>
								<input type="checkbox" id="formula-arbre" name="formulas" value="Un arbre">
								<label for="formula-arbre">
									<div class="picto"></div>
									<div class="choice-title"><span>Un arbre</span></div>
									<div class="choice-price">1.000 €</div>
									<div class="choice-description">Chaque arbre sera planté aux abords du club et constituera le témoignage à long terme de votre engagement dans le projet du Embourg Hockey Club.</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-balleperso" name="formulas" value="Une balle personnalisée">
								<label for="formula-balleperso">
									<div class="picto"></div>
									<div class="choice-title"><span>Une balle de hockey</span> <span>à personnaliser</span></div>
									<div class="choice-price">250 €</div>
									<div class="choice-description">Chaque balle pourra être décorée par son / ses acheteurs.euses et elles seront toutes exposées à long terme au sein du nouveau Club House.</div>
								</label>
							</li>
							<li>
								<input type="checkbox" id="formula-autre" name="formulas" value="Autre formule">
								<label for="formula-autre">
									<div class="picto"></div>
									<div class="choice-title"><span>Autres formules</span> <span>& options sur-mesure</span></div>
									<div class="choice-description">Vous pensez à une autre façon de devenir Supporter et vous souhaitez nous la partager. N’hésitez bien entendu pas à vous faire connaître.</div>
								</label>
							</li>
						</ul>
						<div class="cta">
							<div>
								<button class="slide-next valid-formula">Suivant</button>
							</div>
							<div class="slide-prev">⇽ Retour</div>
							<div class="error-msg">Vous devez sélectionner au moins une option.</div>
						</div>
						
					</div>
				</div>
				<div class="slide" id="slide-form">
					<h2><span>Je complète</span> <span>mes données :</span></h2>

			            <div id="form-saved">
			                Votre message a bien été envoyée ! Merci.
			            </div>

						<div class="the-form">
					        <form id="add-entry-form" 
					        name="add-entry-form" 
					        method="post"
					        action="<?php echo admin_url( 'admin-ajax.php' ); ?>" 
					        class="js-add-entry-form"
					        >
					            <input type="hidden" class="form-action" name="action" value="add_ajax_entry_form">
					            <input type="hidden" class="contact-type" name="contact_type" value="">
								<input type="hidden" class="selected-formula" name="selected_formula" value="">
								<div class="your-selection">
									<label>Vos sélections :</label>
									<div class="selection"><span id="selected-type-label"></span> <br> <span id="selected-formula-label"></span></div>
								</div>
					            <div class="required">
					                <label class="field-label" for="firstname">Prénom<sup>*</sup> :</label>
					                <input class="form-field" required type="text" name="firstname" id="firstname">
					            </div>
					            <div class="required">
					                <label class="field-label" for="lastname">Nom<sup>*</sup> :</label>
					                <input class="form-field" required type="text" name="lastname" id="lastname">
					            </div>
					            <div class="email" class="required">
					                <label class="field-label" for="email">Email<sup>*</sup> :</label>
					                <input class="form-field" required type="email" name="email" id="email">
					            </div>
					            <div class="required">
					                <label class="field-label" for="phone">GSM<sup>*</sup> :</label>
					                <input class="form-field" required type="text" name="phone" id="phone">
					            </div>
					            <div class="if-company">
					                <label class="field-label" for="company_name">Nom du sponsor<sup>*</sup> :</label>
					                <input class="form-field" type="text" name="company_name" id="company_name">
					            </div>
					            <div class="if-company">
					                <label class="field-label" for="company_activity">Secteur d’activités<sup>*</sup> :</label>
					                <input class="form-field" type="text" name="company_activity" id="company_activity">
					            </div>
					            
					            <div class="form-submit">
					                <input type="submit" value="Valider">
					            </div>
					            <div class="slide-prev">⇽ Retour</div>
					            <p class="wait">Veuillez patienter pendant que le formulaire est sauvegardée...</p>
					        </form>
						</div>
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