<?php
    wp_reset_query();
    
    // set a conditional var $currentPage to track whether we are on the staff page or a department detail page
    if( is_page_template('templates/template-departments-detail.php') ){
        $currentPage = 'department-detail'; 
    } else if( is_page_template('templates/template-staff.php') ){
        $currentPage = 'staff';
    }

    $departments = '';
    
    // If there is no $filter then we must be on the siteurl/staff page, viewing senior leadership
    if( $filter == '' )
    {
        // get active departments
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
			// get dept head for each dept
			$args = array(
				"post_type" => "staff"
				,"posts_per_page" => -1
				,'meta_query' => array(
					'relation' => 'AND'
                    ,array("key"=>"department","value"=>'"'.$d->ID.'"',"compare"=>"LIKE")
					,array("key"=>"department_head","value"=>"1","compare"=>"LIKE")
				)
			);
            $manager = get_posts($args);

            // get fields for the dept head
            $managerFields = get_fields($manager[0]->ID);

            // set sprintf guide for department head
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
            
            // write sprintf content for dept head
			$department = sprintf(
                $guide
                ,$managerFields['headshot']['url']
				,$manager[0]->post_title
				,$managerFields['title']
				,$managerFields['description'] // NO LIMIT SET ON DESCRIPTION LENGTH ( but if limit is set, no way to expand it! )
				,( isset($managerFields['phone']) && $managerFields['phone'] != '' ) ? '<a href="tel:'.$managerFields['phone'].'" title="Call '.$manager[0]->post_title.'"><span>&#xE0B0;</span> '.$managerFields['phone'].'</a><br />' : ''
                // if the url field is set (but it shouldnt be afaik) then we always open that URL in a new tab
                ,( !empty($managerFields['url']) ) ? '<a href="'.$managerFields['url'].'" title="Visit '.strtolower($managerFields['department']->post_title ).' website [will open in new window]" target="_blank"><span>&#xE5C8;</span> Visit website</a><br />' : null
                // this filter for 'strategy' is no longer required, and it can be removed ( always show view leadership button ) ( also let strategy appear in the staff filter! )
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
            'name' => $filter,
        );
        $dept = get_posts($args);
		$deptFields = get_fields($dept[0]->ID);

        // get the department head for this department
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
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
                        <p class="description">%s%s</p>
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
			,wp_trim_words($managerFields['description'], 55, ' ...') // need to trim this to excerpt length
            ,( $currentPage === 'department-detail' ) ? '<div class="kri__more-link"><a title="Click here to read more" class="js__bio" href="/staff/bio/'.$manager[0]->post_name.'">Read More</a></div>' : null // if we are on the department detail page... show the learn more buttton
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

		$guide = '<li><div style="background-image: url(%s)"></div><p><span>%s</span><br />%s</p><p>%s</p><p>%s</p><p>%s</p>%s</li>';
        
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
                ,( isset($fields['phone']) ) ? '<a href="tel:'. $fields['phone'] .'">'.$fields['phone'].'</a>' : null
                ,( isset($fields['email']) ) ? '<a href="mailto:'. $fields['email'] .'">e-mail</a>' : null
                ,( $currentPage === 'department-detail' && !empty($fields['description']) ) ? '<a href="/staff/bio/'.$member->post_name.'" title="Click to view profile" class="js__bio">View Profile</a>' : null // if we are on the department detail page... show the learn more buttton
			);
		}
		$departments .= "</ul></section>";
	}
	echo $departments;
?>
