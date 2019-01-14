<?php

	$categories = array(
		 array("People",2)
		,array("Ideas",4)
		,array("News",27)
	);


	$content = "";

	while (have_posts()) : the_post();

		$cat = "";
		foreach($categories as $c){
			if(has_category($c[0])){
				$cat = strtolower($c[0]);
				break;
			}
		}

		if(has_category('nunews') == 1){
			$link = trim(get_the_content());
			$external = true;
		}else{
			$link = get_the_permalink();
			$external = false;
		}

		$content .= '<article id="post-'.get_the_ID().'"  class="category-'.strtolower($cat).' simple">';
		$guide = '<a href="%s" title="Click here now to read more%s"%s><div style="background: url(%s); background-size: cover; background-position: center center;"></div><div><p class="rubric">%s</p><h5>%s</h5><h6>%s</h6></div></a>';
		$content .= sprintf(
			 $guide
			,$link
			,($external?' - will open in a new window':'')
			,($external?' target="_blank"':'')
			,(get_the_post_thumbnail_Url()?get_the_post_thumbnail_Url():"http://fpoimagery.com/?t=px&w=300&h=300&bg=0ff&fg=000000")
			,get_field_object('rubrick',get_the_ID())['value']->name
			,get_the_title()
			,($external?'':get_the_excerpt())
		);
		$content .= '</article>';
	endwhile;
	echo $content.'<br clear="all" />';

?>
