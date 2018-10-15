<?php

	/* Template Name: News Article */


	get_header();

	wp_reset_query();

	$args = array(
	  'name'        => $wp_query->query_vars['show-article'],
	  'post_type'   => 'newsandevents',
	  'numberposts' => 1
	);
	$res = get_posts($args)[0];
	$fields = get_fields($res->ID);

?>

	<main id="news" role="main" aria-label="Content">

		<!-- <div style="width:100vw;background:#000;height:180px;">

		</div>
		<div class="nu__hero-header"><a name="contact"></a>
			<h2><span class="nu__red-span">KRI</span> brings together faculty, industry and students to help solve important security, intelligence and resilience needs. Join the team.</h2>
		</div> -->

		<section class="breadcrumbs">
			<a href="<?=home_url()?>" title="Jump to Kostas Research Institute">Kostas Research Institute</a> > <a href="<?=home_url()?>/news" title="Jump to news">News</a> > <a href="<?=home_url()?>/news/article/<?=$res->post_name?>" title="Reload this page"><?=$res->post_title?></a>
		</section>

		<section class="newsarticle">
			<div>
				<h2><?=$res->post_title?></h2>
				<div class="img" style="background-image: url(<?=$fields['hero_image']['url']?>)"></div>
				<p class="nu__caption"><?=$fields['hero_image_caption']?></p>
				<?=$fields['full_description']?>
				<p>Contact author <a href="<?=$fields['author_link']?>" title="Contact the author [This will open in a new tab/window]" target="_blank"><?=$fields['author_name']?> <span>&#xe89e;</span></a></p>
			</div>
		</section>

	</main>
<?php	wp_reset_query(); get_footer(); ?>
