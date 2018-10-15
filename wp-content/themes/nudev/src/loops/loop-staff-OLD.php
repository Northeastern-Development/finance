<?php


	// if(!isset($_GET['filter']) || $_GET['filter'] == "senior"){
  //
	// 	$args = array(
	// 		'post_type'       => 'classnotes',	// this should be staff, but the content was not entered under that so we need to keep this as is!!!!
	// 		'posts_per_page'  => 1000,
	// 		'paged'           => 1,
	// 		'meta_query' => array(
	// 			'relation' => 'AND',
	// 			'lastname_clause' => array('key' => 'last_name','compare' => 'EXISTS')
	// 		)
	// 		,
	// 		'orderby' => array(
	// 			'lastname_clause' => 'ASC'
	// 		)
	// 	);
  //
	// }else{

		$args = array(
			'post_type'       => 'staff',	// this should be staff, but the content was not entered under that so we need to keep this as is!!!!
			'posts_per_page'  => 1000,
			'paged'           => 1,
			'meta_query' => array(
				'relation' => 'AND',
				'vp_clause' => array('key' => 'vp','compare' => 'EXISTS'),
				'lastname_clause' => array('key' => 'last_name','compare' => 'EXISTS')
			)
			,
			'orderby' => array(
				'vp_clause' => 'DESC',
				'lastname_clause' => 'ASC'
			)
		);

	// }

	// if we are trying to look at a specific category of staff
	if(isset($_GET['filter'])){
		$showCat = null;

		switch($_GET['filter']){
	    case "senior":
				$showCat = 33;
	      break;
	    case "marketing":
	      $showCat = 30;
	      break;
	    case "communications":
	      $showCat = 31;
	      break;
			case "government_relations":
	      $showCat = 32;
	      break;
			case "events":
	      $showCat = 00;
	      break;
			case "special_projects":
	      $showCat = 00;
	      break;
			case "core":
	      $showCat = 00;
	      break;
		}

		$args['category__and'] = array($showCat);

	}


	$res = query_posts($args);

	// die("REC COUNT: ".count($res));

	// print_r($res);
	// die();

	$content = "";

	$extraClass = "";

	$i = 0;

	while (have_posts()) : the_post();

		$fields = get_fields(get_the_ID());

		// if(!isset($_GET['filter']) && $_GET['filter'] != "senior"){	// this will lay out the standard design
    //
		// 	// $headshot = (isset($fields['headshot-square']) && $fields['headshot-square'] != ""?$fields['headshot-square']['url']:'/wp-content/uploads/missingimage.jpg');
    //
		// 	$headshot = (isset($fields['headshot-square']) && $fields['headshot-square'] != ""?$fields['headshot-square']['url']:'http://fpoimagery.com/?t=px&w=900&h=900&bg=0ff&fg=000000');
    //
		// 	$cat = get_the_category(get_the_ID())[0]->name;
    //
		// 	$guide = '<li style="background: url(%s); background-position: center center; background-size: cover;"><div><p>%s %s</p><p>%s%s</p>%s</div></li>';
    //
		// 	$content .= sprintf(
		// 		 $guide
		// 		,$headshot
		// 		,ucwords(trim($fields['first_name']))
		// 		,ucwords(trim($fields['last_name']))
		// 		,trim($fields['title'])
		// 		,($cat != "Senior Team" && $cat != "" ?'<br />'.$cat:'')
		// 		,(isset($fields['email']) && $fields['email'] != ""?'<a href="mailto:'.strtolower(trim($fields['email'])).'"" title="Send an email to '.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'">&#xf003;</a>':'')
		// 	);
    //
		// 	if($i == ((count($res)) - 1) && ($i % 3) > 0){	// make sure we are on the last item
		// 		$i++;
    //
		// 		while($i % 3 > 0){	// until we hit a null mod value, add blank items to finish up the grid
		// 			$content .= "<li>END!!</li>";
		// 			$i++;
		// 		}
    //
		// 	}
    //
		// }else if(isset($_GET['filter']) && $_GET['filter'] != "senior"){	// this will lay out the department design
    //
		// 	$extraClass = "department";
    //
		// 	if($i == 1){
		// 		switch($_GET['filter']){
		// 			case "marketing":
		// 				$content .= '<li class="textblock">MARKETING - With backgrounds ranging from journalism to public relations to politics, our team members have deep expertise in strategic planning and communications, media relations, news reporting, social media, events management, crisis management, and data analytics.</li>';
		// 				break;
		// 			case "communications":
		// 				$content .= '<li class="textblock">COMMUNICATIONS - With backgrounds ranging from journalism to public relations to politics, our team members have deep expertise in strategic planning and communications, media relations, news reporting, social media, events management, crisis management, and data analytics.</li>';
		// 				break;
		// 			case "government_relations":
		// 				$content .= '<li class="textblock">GOVERNMENT RELATIONS - With backgrounds ranging from journalism to public relations to politics, our team members have deep expertise in strategic planning and communications, media relations, news reporting, social media, events management, crisis management, and data analytics.</li>';
		// 				break;
		// 		}
		// 	}
    //
		// 	if($i == 0){	// whether we need the banner style image or the regular square
		// 		// $headshot = (isset($fields['headshot-banner']) && $fields['headshot-banner'] != ""?$fields['headshot-banner']['url']:'/wp-content/uploads/missingimage.jpg');
		// 		$headshot = (isset($fields['headshot-banner']) && $fields['headshot-banner'] != ""?$fields['headshot-banner']['url']:'http://fpoimagery.com/?t=px&w=900&h=500&bg=0cf&fg=000000');
		// 	}else{
		// 		// $headshot = (isset($fields['headshot-square']) && $fields['headshot-square'] != ""?$fields['headshot-square']['url']:'/wp-content/uploads/missingimage.jpg');
		// 		$headshot = (isset($fields['headshot-square']) && $fields['headshot-square'] != ""?$fields['headshot-square']['url']:'http://fpoimagery.com/?t=px&w=900&h=900&bg=0ff&fg=000000');
		// 	}
    //
		// 	$guide = '<li style="background: url(%s); background-position: center center; background-size: cover;"><div><p>%s %s</p><p>%s</p><div class="biocontent" id="staff-%s">%s</div>%s</div></li>';
    //
		// 	$content .= sprintf(
		// 		 $guide
		// 		,$headshot
		// 		,ucwords(trim($fields['first_name']))
		// 		,ucwords(trim($fields['last_name']))
		// 		,ucwords(trim($fields['title']))
		// 		,$i
		// 		,'<p class="title">'.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'<br />'.ucwords(trim($fields['title'])).'</p>'.trim($fields['bio'])
		// 		,($i == 0?'<a href="#'.strtolower(trim($fields['email'])).'"" title="Read more about '.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'" class="js__bio" id="'.$i.'">Read Bio</a>':'<a href="mailto:'.strtolower(trim($fields['email'])).'"" title="Read more about '.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'" id="'.$i.'">&#xf003;</a>')
		// 	);
    //
		// }else if(isset($_GET['filter']) && $_GET['filter'] == "senior"){	// this will lay out the senior team design

			$extraClass = "seniorteam";

			// if($i == 1){
			// 	$content .= '<li class="textblock">With backgrounds ranging from journalism to public relations to politics, our team members have deep expertise in strategic planning and communications, media relations, news reporting, social media, events management, crisis management, and data analytics.</li>';
			// }

			// $headshot = (isset($fields['headshot-banner']) && $fields['headshot-banner'] != ""?$fields['headshot-banner']['url']:'/wp-content/uploads/missingimage.jpg');

			$headshot = (isset($fields['headshot-banner']) && $fields['headshot-banner'] != ""?$fields['headshot-banner']['url']:'http://fpoimagery.com/?t=px&w=900&h=500&bg=0cf&fg=000000');

			$guide = '<li style="background: url(%s); background-position: center center; background-size: cover;"><div><p>%s %s</p><p>%s</p><div class="biocontent" id="staff-%s">%s</div>%s</div></li>';

			$content .= sprintf(
				 $guide
				,$headshot
				,ucwords(trim($fields['first_name']))
				,ucwords(trim($fields['last_name']))
				,ucwords(trim($fields['title']))
				,$i
				,'<p class="title">'.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'<br />'.ucwords(trim($fields['title'])).'</p>'.trim($fields['bio'])
				,'<a href="#'.strtolower(trim($fields['email'])).'" title="Read more about '.ucwords(trim($fields['first_name'])).' '.ucwords(trim($fields['last_name'])).'" class="js__bio" id="'.$i.'">Read Bio</a>'
			);

		// }

		$i++;

	endwhile;

	echo '<ul class="'.$extraClass.'">'.$content.'</ul>';

?>
