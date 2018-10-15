<?php

  wp_reset_postdata();

	// this loop will build out the most recent articles from each of the main categories
	$max = 2;

	$categories = array(
		 array("People",2)
		,array("Ideas",4)
		,array("News",27)
	);

	foreach($categories as $c){

?>

<div class="category-<?=strtolower($c[0])?>">

	<div class="catheader">
		<p class="underlineheader"><?=$c[0]?></p>
	</div>
<?php

	$query = new WP_Query(array('category__and' => array($c[1],102),'showposts' => $max) );


	if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();

	?>



	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
			if(has_category('nunews') == 1){
				$link = trim(get_the_content());
				$external = true;
			}else{
				$link = get_the_permalink();
				$external = false;
			}

			$thumb_id = get_post_thumbnail_id();
			$imgUrl = wp_get_attachment_image_src($thumb_id,'large');
		?>




		<div class="thumbnail" style="background: url(<?=($imgUrl != ""?$imgUrl[0]:"http://fpoimagery.com/?t=px&w=300&h=300&bg=0ff&fg=000000")?>); background-size: cover; background-position: center center;"><a href="<?=$link?>" title="<?php echo get_the_title().($external?" - will open in new window":"");?>"<?=($external?"target=\"_blank\"":"")?>><?php echo get_the_title(); ?></a></div>
    <a href="<?=$link?>" title="<?php echo get_the_title().($external?" - will open in new window":"");?>"<?=($external?"target=\"_blank\"":"")?>>
		<p class="rubric"><?=get_field_object('rubrick')['value']->name?></p>
		<?php
			if(has_category('nunews') == 1){
				$link = trim(get_the_content());
		?>
			<h5><?php the_title(); ?> &#xf08e;</h5>
		<?php
			}else{
		?>
			<h5><?php the_title(); ?></h5>
		<?php } ?>
    <?php if(!$external){ ?>
		    <!-- <h6><?=($external?'&nbsp;':get_the_excerpt())?></h6> -->
        <h6><?=get_the_excerpt()?></h6>
    <?php } ?>
	</a></div>
<?php
	endwhile;
?>

	<a class="seeall" href="<?=home_url()?>/<?=strtolower($c[0])?>" title="See all <?=$c[0]?>"><span class="chevron">&#xf138;</span> <span class="copy">See all <span><?=$c[0]?></span></span></a>

</div>

<?php endif; }?>
