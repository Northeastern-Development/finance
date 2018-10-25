<?php

	wp_reset_query();

	$res = get_fields(get_the_ID());

	$related = '';



	// need to add a fix in here to allow for multiple variations of related post types: images and copy, copy only, links, etc.



	if($res['use_pre-footer'] == "1" && isset($res['pre-footer_image_block']) && $res['pre-footer_image_block'] != ''){

		$related .= '<div class="nu__prefooter"><p>Related Resources</p><div><ul>';

		$guide = '<li><a href="%s" title="%s"%s><div class="image"><div style="background-image: url(%s);"></div></div><h4>%s<span>&#xE8E4;</span></h4><p>%s</p></a></li>';

		foreach($res['pre-footer_image_block'] as $r){

			$fields = get_fields($r['items'][0]['item']->ID);

			$related .= sprintf(
				$guide
				,$fields['link']
				,$r['block_title'].(isset($fields['external_link']) && $fields['external_link'] == "1"?' [will open in new window]':'')
				,(isset($fields['external_link']) && $fields['external_link'] == "1"?' target="_blank"':'')
				,$fields['image']['url']
				,$r['block_title']
				,$fields['description']
			);
		}

		$related .= '</ul></div></div>';

	}

	echo $related;

?>
