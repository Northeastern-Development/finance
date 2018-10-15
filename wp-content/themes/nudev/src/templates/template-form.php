<?php /* Template Name: Form */ get_header(); ?>

<main id="location" role="main" aria-label="Content">
	<div style="width:100vw;background:#000;height:180px;">


	</div>
	<div class="nu__hero-header">
		<h2>Tell us how we can help your business and we'll get back to you shortly.</h2>
	</div>

	<section id="form">
		<div class="nu__form">

			<?=do_shortcode( '[wpforms id="24"]' );?>
		</div>
	</section>



</main>
<?php get_footer(); ?>
