<?php
   
	wp_reset_query();

    $departments = '';
    
    if($filter == ''){	// this is for the SLT
        $args = array(
            'post_type' => 'departments',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'status',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        $depts = get_posts($args);
        foreach($depts as $d)
        {
			// get the manager of this department
			$args = array(
				 "post_type" => "staff"
				,"posts_per_page" => -1
				,'meta_query' => array(
					 'relation' => 'AND'
					,array("key"=>"type","value"=>"individual","compare"=>"=")
                    ,array("key"=>"department","value"=>'"'.$d->ID.'"',"compare"=>"LIKE")
					,array("key"=>"department_head","value"=>"1","compare"=>"LIKE")
				)
			);
            $manager = query_posts($args);
            $managerFields = get_fields($manager[0]->ID);
            $guide = '
                <article>
                    <div>
                        <div style="background-image: url(%s)"></div>
                    </div>
                    <div>
                        <p class="nametitle"><span>%s</span><br />%s</p>
                        <p class="description">%s</p>
                        <p class="contact">%s%s</p>
                    </div>
                </article>
            ';
			$department = sprintf(
				$guide
                ,$managerFields['headshot']['url']
				,$manager[0]->post_title
				,$managerFields['title']
				,$managerFields['description']
				,(isset($managerFields['phone']) && $managerFields['phone'] != ''?'<a href="tel:'.$managerFields['phone'].'" title="Call '.$manager[0]->post_title.'"><span>&#xE0B0;</span> '.$managerFields['phone'].'</a><br />':'')
				,($d->post_title != 'Strategy'?'<a href="'.home_url().'/staff/'.str_replace(" ","-",strtolower($d->post_title)).'" title="Filter to show '.strtolower($d->post_title).' team"><span>&#xE7EF;</span> View Leadership</a>':'')
            );
			$departments .= '<section class="nu__slt">'.$department.'</section>';
		}
    }
    else
    {   // this is for a specific department
		$args = array(
			 "post_type" => "staff"
			 ,'meta_query' => array(
 				 'relation' => 'AND'
				 ,array("key"=>"type","value"=>"Department","compare"=>"=")
			 	,array("key"=>"department","value"=>'"'.str_replace("-"," ",$filter).'"',"compare"=>"LIKE")
			)
		);
		$dept = query_posts($args);
		$deptFields = get_fields($dept[0]->ID);
		// get the manager of this department
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
				,array("key"=>"type","value"=>"individual","compare"=>"=")
				,array("key"=>"department","value"=>'"'.str_replace("-"," ",$filter).'"',"compare"=>"LIKE")
				,array("key"=>"department_head","value"=>"1","compare"=>"=")
			)
		);
		$manager = query_posts($args);
		$managerFields = get_fields($manager[0]->ID);
		$guide = '<section class="nu__team"><article><div><p class="description">%s</p><p class="contact"><a href="tel:%s" title="Call %s"><span>&#xE0B0;</span>%s</a><br /><a href="%s" title="Visit website [will open in new window]" target="_blank"><span>&#xE5C8;</span> Visit website</a></p></div><div><div style="background-image: url(%s);"></div><p><span>%s</span><br />%s</p></div></article></section>';
		$department = sprintf(
			$guide
			,$deptFields['description']
			,$deptFields['phone']
			,strtolower($dept[0]->post_title)
			,$deptFields['phone']
			,$deptFields['url']
			,$managerFields['headshot']['url']
			,$manager[0]->post_title
			,$managerFields['title']
		);
		$departments .= $department;


		// now we can gather up the members of the department ordered by sub-type
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
				,'type_clause' => array("key"=>"type","value"=>"individual","compare"=>"=")
				,'sub-type_clause' => array("key"=>"sub_type","compare"=>"EXISTS")
				,'dept_clause' => array("key"=>"department","value"=>'"'.str_replace("-"," ",$filter).'"',"compare"=>"LIKE")
				,array("key"=>"department_head","value"=>"0","compare"=>"LIKE")
			)
		);

		$res = query_posts($args);

		$subType = get_fields($res[0]->ID)['sub_type'];

		$departments .= '<section class="nu__team-list">'.($subType != "" ?'<h3>'.$subType.'</h3>':'').'<ul>';

		$guide = '<li><div style="background-image: url(%s);"></div><p><span>%s</span><br />%s</p><p>%s</p><p>%s</p><p>%s</p></li>';

		foreach($res as $r){
			$fields = get_fields($r->ID);
			// print_r($r);
			// print_r($fields);

			if($fields['sub_type'] != $subType){
				$subType = $fields['sub_type'];
				$departments .= '</ul>'.($subType != "" ?'<h3>'.$subType.'</h3>':'').'<ul>';
			}

			$departments .= sprintf(
				$guide
				,$fields['headshot']['url']
				,trim($r->post_title)
                ,trim($fields['title'])
                ,( isset($fields['expert_at'])) ? 'Expert at: '.$fields['expert_at'] : null
                ,( isset($fields['phone']) ) ? '<a href="tel:"'. $fields['phone'] .'">'.$fields['phone'].'</a>' : null
                ,( isset($fields['email']) ) ? '<a href="mailto:"'. $fields['email'] .'">e-mail</a>' : null
			);

		}

		$departments .= "</ul></section>";

	}

	echo $departments;

?>
