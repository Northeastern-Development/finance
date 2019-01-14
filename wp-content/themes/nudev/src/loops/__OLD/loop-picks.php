<?php

$categories = array(
	 array("People",2)
	,array("Ideas",4)
	,array("News",27)
);

	// build the grid of featured articles here
	query_posts('cat=30&showposts=4');
	if (have_posts()): while (have_posts()) : the_post();

		$cat = "";
		foreach($categories as $c){
			if(has_category($c[0])){
				$cat = strtolower($c[0]);
				break;
			}
		}


		// get the article link
		if(has_category('nunews') == 1){
			$link = trim(get_the_content());
			$external = true;
		}else{
			$external = false;
			$link = get_the_permalink();
		}


		$thumb_id = get_post_thumbnail_id();
		$imgUrl = wp_get_attachment_image_src($thumb_id,'thumbnail');

		$guide = '<li class="category-%s"><a href="%s" title="%s"%s><img src="%s" alt="%s" /><p class="rubric">%s</p><h5>%s</h5><h6>%s</h6></a></li>';

		$content .= sprintf(
			 $guide
			 ,$cat
			 ,$link
			 ,get_the_title().($external?" - will open in new window":"")
			 ,($external?" target=\"_blank\"":"")
			 ,($imgUrl != ""?$imgUrl[0]:"http://fpoimagery.com/?t=px&w=300&h=300&bg=0ff&fg=000000")
			 ,strtolower(get_the_title())." thumbnail image"
			 ,get_field_object('rubrick')['value']->name
			//  ,$link
			//  ,get_the_title().($external?" - will open in new window":"")
			//  ,($external?" target=\"_blank\"":"")
			 ,get_the_title().($external?" &#xf08e;":"")
			 ,(get_the_excerpt() != ""?get_the_excerpt():"&nbsp;<br />&nbsp;<br />&nbsp;")
		);

	endwhile;
endif;
?>


<ul>
<?=$content?>
</ul>
