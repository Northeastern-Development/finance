<?php

	/* Template Name: Staff */

	/*

	Eventually this page may include the use of a filter ala the administration page of main EDU

	*/

	get_header();

	wp_reset_query();

	$department = "leadership";

	$deptTitle = 'KRI Leadership';
?>

	<main id="staff" role="main" aria-label="Content">

		<div style="width:100vw;background:#000;height:180px;">

		</div>
		<div class="nu__hero-header"><a name="contact"></a>
			<h2><span class="nu__red-span">KRI</span> is lead by academic and industry experts who know how to translate discoveries to the marketplace.</h2>
		</div>

		<section class="departmenthead">
			<?php include(locate_template('loops/loop-staff-departmenthead.php')); ?>
		</section>

		<section class="stafflist">
			<div>
				<h2><?=$deptTitle?></h2>
				<ul>
					<?php include(locate_template('loops/loop-staff.php')); ?>
				</ul>
			</div>
		</section>

	</main>
<?php	wp_reset_query(); get_footer(); ?>
