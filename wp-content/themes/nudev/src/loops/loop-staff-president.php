<?php

	// grab the details for the president
	$args = array(
		 "post_type" => "staff"
		,"posts_per_page" => 1
		,'meta_query' => array(
			 'relation' => 'AND'
			,array("key"=>"department","value"=>"President","compare"=>"LIKE")
		)
	);
	$res = query_posts($args);

	$fields = get_fields($res[0]->ID);

	// $srcSet = ar_responsive_image(get_field('headshot',$res[0]->ID)['id'],'medium','640px');

	$guide = '<section class="nu__president"><div style="background-image: url(%s);"><div></div><p><span>%s</span><br />President</p></div><div><h3>Office of the President</h3><p>%s</p><p><a href="tel:%s" title="Call the Office of the President"><span>&#xE0B0;</span> %s</a><br /><a href="%s" title="Visit website [will open in new window]" target="_blank"><span>&#xE5C8;</span> Visit website</a></p></div></section>';

	$president = sprintf(
		$guide
		,$fields['headshot']['url']
		,$res[0]->post_title
		,$fields['description']
		,$fields['phone']
		,$fields['phone']
		,$fields['url']
	);

	echo $president;

?>
