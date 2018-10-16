<?php

	/* Template Name: staff */

	get_header();

	wp_reset_query();

	// we need to be able to translate back the custom pretty URL to get the correct filter if one has been optioned
	$fChk = $wp_query->query_vars['team-filter'];
	$filter = (isset($fChk) && $fChk != ''?$fChk:'');

?>

	<div class="main" role="main" aria-label="content">

		<?php include(locate_template('/includes/pagehero.php')); ?>

		<?php include(locate_template('loops/loop-staff-president.php')); ?>

		<section class="nu__filters">
			<h2>Leadership Team</h2>
			<input id="toggle" type="checkbox" title="Click to select">
			<div>
				<ul>
					<li><a <?=($filter == ''?'class="active"':'')?> href="<?=home_url()?>/staff/" title="Show senior leadership team">Senior Leadership <span>&#xE313;</span></a></li>
					<?php include(locate_template('loops/loop-staff-filters.php')); ?>
				</ul>
				<div title="Click to show/hide more options" class="js__showmore">More</div>
			</div>
		</section>

		<?php  include(locate_template('loops/loop-staff.php')); ?>

	</div>

<?php

	if($filter != ''){
		echo '<script> $(document).ready(function(){ $("html, body").animate({scrollTop: $("section.nu__filters").offset().top - ($("header").height() + 20)},0); });</script>';
	}

	get_footer();
?>
