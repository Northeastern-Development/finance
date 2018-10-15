




	<?php

	$res = get_posts(array('post_type' => 'careers'));

	// print_r($res);
	// die();

	$guide = "";
	$content = "";
	$i=0;
	foreach($res as $r){

		$fields = get_fields($r->ID);
		// print_r($fields);
		// echo $fields['title'];


		$nav = '<ul class="noautoscroll"><li><a class="active" href="<?=home_url()?>/employment"  title="Click here to view all open positions">All Current<br />Positions ('.count($res).')</a></li><!-- <li><a href="<?=home_url()?>/employment/full-time-faculty"  title="Click here to view full-time faculty positions">Full-Time Faculty<br />Positions (X)</a></li><li><a href="<?=home_url()?>/employment/part-time-faculty" title="Click here to view part-time faculty positions">Part-Time Faculty<br />Positions (X)</a></li><li><a href="<?=home_url()?>/employment/professional-management-staff" title="Click here to view professional, management and staff positions">Professional,<br/>Management and<br />Staff (X)</a></li> --></ul>';

		$guide = '<section><div class="flexbox"><div class="nu__col nu__col-left">'.($i===0?$nav:'').'</div><div class="nu__col nu__col-right"><div style="clear:both;"></div><div class="nu__col-copy"><h2>%s%s</h2><br />%s<a class="learnmoreapply" href="'.$fields['hr_link'].'" title="Click here to learn more and apply online" target="_blank">Learn More &amp; Apply Online</a></div></div></div></section>';



		$content .= sprintf(
			 $guide
			,$fields['title']
			,(isset($fields['sub_title']) && $fields['sub_title'] != ""?" -<br />".$fields['sub_title']:"")
			,$fields['description']
		);

		$i++;
	}


	// die();








		// echo "dfgjfghjfghjf";

		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		//$pageMax = 20;

		// find the class notes
		//$posts = get_posts('post_type=careers');

		//print_r($posts);

		//die();

		//$orderBy = (isset($_GET['orderby'])?$_GET['orderby']:"DESC");
		//$school = (isset($_GET['school_college']) && $_GET['school_college'] != ""?$_GET['school_college']:false);
		//$classYear = (isset($_GET['class_year']) && $_GET['class_year'] != ""?$_GET['class_year']:false);
		//$category = (isset($_GET['category']) && $_GET['category'] != ""?$_GET['category']:false);

		// $content = "rtyjfgkukghjkghjkghj";

		//
		// $metaCheck = array();
		// if($school){
		// 	$metaCheck[] = array("key"=>"school_college","value"=>str_replace("and","&",$school),"compare"=>"=");
		// }
		// if($classYear){
		// 	$yearParts = explode("-",$classYear);
		// 	// echo count($yearParts);
		// 	// print_r($yearParts);
		// 	if(count($yearParts) > 1){
		// 		// die($classYear);
		// 		$metaCheck[] = array("key"=>"class_year","value"=>array($yearParts[1],$yearParts[0]),"compare"=>"between");
		// 		//print_r($yearParts);
		// 		//die();
		// 		// $metaCheck[] = array("key"=>"class_year","value"=>$yearParts[1],"compare"=>"<");
		// 	}else{
		// 		$metaCheck[] = array("key"=>"class_year","value"=>$classYear,"compare"=>"=");
		// 	}
		// }
		// if($category){
		// 	$metaCheck[] = array("key"=>"category","value"=>$category,"compare"=>"=");
		// }



		// $args = array(
		// 	 "post_type"=>"careers"
		// 	,"posts_per_page"=>$pageMax
		// 	,"paged"=>$paged
		// 	// ,"order"=>$orderBy
		// 	// ,"meta_query"=>$metaCheck
		// );
		// $res = query_posts('post_type=careers');
		//$res = new WP_query(array('post_type'=>'careers'));
		// query_posts('post_type=careers');
		// $res = query_posts($args);


		//print_r($res);
		//die();

		//print_r($res[0]);


		// $content = "dhyj";
		//$guide = "";
		//$i = 0;
		// if($paged === 0){
		// 	$cYear = date("Y");
		// }else{
			//$tempDate = date_create($res[0]->post_date);
			//$cYear = date_format($tempDate,"Y");
		// }
		//while ($res->have_posts()) : $res->the_post();

		// echo "POST";

			//$content .= "dfgjfghjghjfgh";


		// foreach($posts as $p){

			// print_r($p);

			// echo $p->post_date;





			//$postYear = get_the_date('Y',get_the_ID());
			//$postDate = get_the_date('F d, Y',get_the_ID());


			// if($paged > 0){
			//
			// }

			// echo get_the_date('Y',get_the_ID());

			//$postDate = date_create($p->post_date);

			// $content .= $postDate;

			// if($i === 0 && $paged === 0){
			// 	$content .= "<h2>Notes From ".$cYear."</h2>";
			// }
			//
			//
			// if($postYear != $cYear && $i > 0){
			// 	$content .= "<h2>Notes From ".$postYear."</h2>";
			// 	$cYear = $postYear;
			// }



			// wp_update_post( $p );

			// $fields = get_fields(get_the_ID());
			// echo "DATA: ";
			// print_r($fields);

			// print_r(get_post_meta(get_the_ID()));

			// if(isset($fields['class_year'])){
			// 	$classYear = $fields['class_year'];
			// }else{
			// 	$classYear = get_post_meta(get_the_ID(),'class_year',true);
			// }

			// echo "YEAR: ".$classYear."<br />";

			// $imageParts = explode("\">http:",str_replace(array("</a>"),"",$fields['image']));
			//
			// if(trim($fields['first_name']) === "Julie" && trim($fields['last_name']) === "Bonette"){
			// 	$imageParts = "";
			// }



			// $guide = '<div id="%s">%s<div><h3>%s</h3>%s%s%s<h6>%s</h6<h6>%s</h6></div></div>';
			// $content .= sprintf(
			// 	 $guide
			// 	,$p->ID
			// 	,(isset($imageParts[1]) && $imageParts[1] != ""?"<div class=\"noteimage\"><img src='http:".$imageParts[1]."' alt='class note image' /></div>":"")
			// 	,trim($fields['first_name'])." ".trim($fields['last_name'])
			// 	,(isset($fields['school_college']) && $fields['school_college'] != ""?"<h5>".trim($fields['school_college'])."</h5>":"")
			// 	,(isset($classYear) && $classYear != ""?"<h5>Class of ".trim($classYear)."</h5>":"")
			// 	,$fields['note']
			// 	,(isset($fields['image_caption']) && $fields['image_caption'] != ""?$fields['image_caption']:"")
			// 	,"Submitted on ".$postDate." in ".$fields['category']
			// );

			//$i++;
		// }
		//endwhile;

		 //wp_reset_postdata();

		echo $content;

		?>
