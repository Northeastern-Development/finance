<?php

	$max = 4;

	$categories = array(
		 array("People",2)
		,array("Ideas",4)
		,array("News",27)
	);

	// build the grid of featured articles here
	$posts = get_posts('cat=3&showposts='.$max);

	$content = "";
	$guide = "";
	$i = 1;
	foreach($posts as $p){

		$cat = "";
		foreach($categories as $c){
			if(has_category($c[0],$p->ID)){
				$cat = strtolower($c[0]);
				break;
			}
		}

		$content .= '<article id="'.$p->ID.'" class="category-'.$cat.'">';

		switch($i){
			case 1:
        // $guide = '<a href="%s" title="Click here now to read more"><div style="background: url(%s); background-size: cover; background-position: center center;"></div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6><span class="chevron invert">></span></div></a>';
				$guide = '<a href="%s" title="Click here now to read more"><div style="background: url(%s); background-size: cover; background-position: center center;"></div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6></div></a>';
				$content .= sprintf(
					 $guide
					,get_permalink($p->ID)
					,get_the_post_thumbnail_Url($p->ID)
					,get_field_object('rubrick',$p->ID)['value']->name
					,$p->post_title
					,$p->post_excerpt
				);
        break;
	    case 2:
				$guide = '<a href="%s" title="Click here now to read more"><div%s><p class="rubric">%s</p><h1>%s</h1>%s</div><div style="background: url(%s); background-size: cover; background-position: center center;"%s>&nbsp;</div></a>';
				$content .= sprintf(
					 $guide
					,get_permalink($p->ID)
					,($p->post_excerpt == ""?' class="tall"':'')
					,get_field_object('rubrick',$p->ID)['value']->name
					,$p->post_title
					,($p->post_excerpt != ""?'<h6>'.$p->post_excerpt.'</h6>':'')
					,get_the_post_thumbnail_Url($p->ID)
					,($p->post_excerpt == ""?' class="tall"':'')
				);
        break;
	    case 3:
				$guide = '<a href="%s" title="Click here now to read more"><div style="background: url(%s); background-size: cover; background-position: center center;">&nbsp;</div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6></div></a>';
				$content .= sprintf(
					 $guide
					,get_permalink($p->ID)
					,get_the_post_thumbnail_Url($p->ID)
					,get_field_object('rubrick',$p->ID)['value']->name
					,$p->post_title
					,$p->post_excerpt
				);
        break;
			case 4:
				$guide = '<a href="%s" title="Click here now to read more"><div class="catborders"><p class="rubric">%s</p><h1>%s</h1></div></a>';
				$content .= sprintf(
					 $guide
					,get_permalink($p->ID)
					,get_field_object('rubrick',$p->ID)['value']->name
					,$p->post_title
				);
        break;
		}

		$content .= '</article>';

		$i++;
	}

	echo $content;

	?>
