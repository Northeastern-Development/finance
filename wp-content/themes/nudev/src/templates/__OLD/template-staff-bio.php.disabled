<?php

	/* Template Name: Bio */

	$args = array(
	  'name'        => $wp_query->query_vars['show-bio'],
	  'post_type'   => 'staff',
	  'numberposts' => 1
	);
	$res = get_posts($args)[0];
	$fields = get_fields($res->ID);

?>

<div id="staffbio">
	<div class="contact">
		<div>
			<h2><?=$fields['first_name'].' '.$fields['last_name'].(isset($fields['credentials']) && $fields['credentials'] != ""?', '.$fields['credentials']:'')?></h2>
			<?=(isset($fields['title']) && $fields['title'] != ""?'<h3>'.$fields['title'].'</h3>':'')?>
			<?=(isset($fields['email']) && $fields['email'] != ""?'<h4><div class="kri__more-link"><a href="mailto:'.$fields['email'].'" title="Send an email" class="email">'.$fields['email'].'</a></div></h4>':'')?>
			<?=(isset($fields['phone']) && $fields['phone'] != ""?'<h4><div class="kri__more-link"><a href="tel:'.$fields['phone'].'" title="Call" class="phone">'.$fields['phone'].'</a></div></h4>':'')?>
		</div>
		<div style="background: url(<?=$fields['headshot']['url']?>);"></div>
	</div>
	<div class="about">
		<h3>About</h3>
		<?=$fields['bio']?>
	</div>
</div>

<?php unset($args,$res,$fields);	// cleanup ?>
