<?php

$pageMax = 9;

$categories = array(
	 array("People",2)
	,array("Ideas",4)
	,array("News",27)
);
$classes = get_body_class();

foreach($categories as $c){
	if(in_array(strtolower($c[0]),$classes)){
		$cat = $c;
		break;
	}
}



	query_posts('cat='.$cat[1].'&posts_per_page='.$pageMax.'&paged='.$paged);



	$content = "";
	$i = 1;
	while (have_posts()) : the_post();

		if(has_category('nunews') == 1){
			$link = trim(get_the_content());
			$external = true;
		}else{
			$link = get_the_permalink();
			$external = false;
		}



		if(isset($paged) && $paged > 1){
			$content .= '<article id="post-'.get_the_ID().'"  class="category-'.strtolower($cat[0]).' simple">';
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
		}else{

			$content .= '<article id="post-'.get_the_ID().'"  class="category-'.strtolower($cat[0]).'">';

			switch($i){
				case 1:
					$guide = '<a href="%s" title="Click here now to read more%s"%s><div style="background: url(%s); background-size: cover; background-position: center center;"></div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6></div></a>';
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
					break;
				case 3:
					$guide = '<a href="%s" title="Click here now to read more%s"%s><div style="background: url(%s); background-size: cover; background-position: center center;">&nbsp;</div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6></div></a>';
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
					break;
				default:
					$guide = '<a href="%s" title="Click here now to read more%s"%s><div style="background: url(%s); background-size: cover; background-position: center center;">&nbsp;</div><div><p class="rubric">%s</p><h1>%s</h1><h6>%s</h6></div></a>';
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
					break;
			}

			$content .= '</article>';

		}







		$i++;
	endwhile;



	echo $content.'<br clear="all" />';

	?>
