<?php
   
	wp_reset_query();

    $departments = '';
    
    /**
     * Has No Filter ( basic /staff/ page )
     */
    if($filter == '')
    {
        // get departments
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
        // loop departments as department
        foreach($depts as $d)
        {
			// get department manager from staff
			$args = array(
				 "post_type" => "staff"
				,"posts_per_page" => -1
				,'meta_query' => array(
					 'relation' => 'AND'
					// ,array("key"=>"type","value"=>"individual","compare"=>"=") // type is depricated now
                    ,array("key"=>"department","value"=>'"'.$d->ID.'"',"compare"=>"LIKE")
					,array("key"=>"department_head","value"=>"1","compare"=>"LIKE")
				)
			);
            $manager = get_posts($args);
            $managerFields = get_fields($manager[0]->ID);
            $guide = '
                <article>
                    <div>
                        <div style="background-image: url(%s)"></div>
                    </div>
                    <div>
                        <p class="nametitle"><span>%s</span><br />%s</p>
                        <p class="description">%s</p>
                        <p class="contact">%s%s%s</p>
                    </div>
                </article>
            ';
            // add the URL back
			$department = sprintf(
                $guide
                ,$managerFields['headshot']['url']
				,$manager[0]->post_title
				,$managerFields['title']
				,$managerFields['description']
				,( isset($managerFields['phone']) && $managerFields['phone'] != '' ) ? '<a href="tel:'.$managerFields['phone'].'" title="Call '.$manager[0]->post_title.'"><span>&#xE0B0;</span> '.$managerFields['phone'].'</a><br />' : ''
                ,( !empty($managerFields['url']) ) ? '<a href="'.$managerFields['url'].'" title="Visit '.strtolower($managerFields['department']->post_title ).' website [will open in new window]" target="_blank"><span>&#xE5C8;</span> Visit website</a><br />' : null
				,($d->post_title != 'Strategy') ? '<a href="'.home_url().'/staff/'.str_replace(" ","-",strtolower($d->post_title)).'" title="Filter to show '.strtolower($d->post_title).' team"><span>&#xE7EF;</span> View Leadership</a>' : ''
            );
			$departments .= '<section class="nu__slt">'.$department.'</section>';
		}
    }
    /**
     * Has Department Filter, i.e.  siteurl/staff/department
     */
    else
    {
        // get the department matching the filter (by name)
        $args = array(
            'post_type' => 'departments',
            'name' => str_replace('-', ' ', $filter)
        );
        $dept = get_posts($args);
		$deptFields = get_fields($dept[0]->ID);

        // get the department head for this department
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
				// ,array("key"=>"type","value"=>"individual","compare"=>"=") // type is depricated
				,array("key"=>"department","value"=>'"'. $dept[0]->ID .'"',"compare"=>"LIKE")
				,array("key"=>"department_head","value"=>"1","compare"=>"=")
			)
		);
		$manager = get_posts($args);
        $managerFields = get_fields($manager[0]->ID);
        // set guide for writing the department head
        $guide = '
            <section class="nu__team">
                <article>
                    <div>
                        <p class="description">%s</p>
                        <p class="contact"><a href="tel:%s" title="Call %s"><span>&#xE0B0;</span>%s</a><br /></p>
                        <p>%s</p>
                    </div>
                    <div>
                        <div style="background-image: url(%s);"></div>
                        <p><span>%s</span><br />%s</p>
                    </div>
                </article>
            </section>
        ';
        // write department head first, above the team
		$department = sprintf(
			$guide
			,$managerFields['description']
			,$managerFields['phone']
			,strtolower($dept[0]->post_title)
            ,$managerFields['phone']
            ,( !empty($managerFields['url']) ) ? '<a href="'.$managerFields['url'].'" title="Visit '.strtolower($managerFields['department']->post_title ).' website [will open in new window]" target="_blank"><span>&#xE5C8;</span> Visit website</a><br />' : null
			,$managerFields['headshot']['url']
			,$manager[0]->post_title
			,$managerFields['title']
		);
		$departments .= $department;


        // get team members that have been organized by sub-type
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
				// ,'type_clause' => array("key"=>"type","value"=>"individual","compare"=>"=") // type field is depricated
				,'sub-type_clause' => array("key"=>"sub_type","compare"=>"EXISTS") 
				,'dept_clause' => array("key"=>"department","value"=>'"'.$dept[0]->ID.'"',"compare"=>"LIKE")
				,array("key"=>"department_head","value"=>"0","compare"=>"LIKE")
			)
		);
		$members = get_posts($args);

        // get the first sub-type
		$subType = get_fields($members[0]->ID)['sub_type'];

        // if there is a sub-type, open the team list with that heading
		$departments .= '<section class="nu__team-list">'.($subType != "" ?'<h3>'.$subType.'</h3>':'').'<ul>';

		$guide = '<li><div style="background-image: url(%s)"></div><p><span>%s</span><br />%s</p><p>%s</p><p>%s</p><p>%s</p></li>';

        // loop remaining staff members
		foreach($members as $member){
			$fields = get_fields($member->ID);
            // if this member is not in the current subtype,
			if($fields['sub_type'] != $subType){
                // set the new subtype
                $subType = $fields['sub_type'];
                // end the last subtype grouping, and create a new subtype grouping
				$departments .= '</ul>'.($subType != "" ?'<h3>'.$subType.'</h3>':'').'<ul>';
			}
            // write the member ( as li )
			$departments .= sprintf(
				$guide
				,$fields['headshot']['url']
				,trim($member->post_title)
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
