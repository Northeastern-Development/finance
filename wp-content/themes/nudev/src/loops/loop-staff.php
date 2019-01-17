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
			$department = sprintf(
                $guide
                ,$managerFields['headshot']['url']
				,$manager[0]->post_title
				,$managerFields['title']
				,$managerFields['description']
				,(!empty($managerFields['phone'])) ? '<a class="neu__iconlink" href="tel:'.$managerFields['phone'].'" title="Call '.$manager[0]->post_title.'"><i class="material-icons">phone</i><span>'.$managerFields['phone'].'</span></a><br />' : null
                ,(!empty($managerFields['url'])) ? '<a class="neu__iconlink" href="'.$managerFields['url'].'" title="Visit '.strtolower($managerFields['department']->post_title ).' website [will open in new window]" target="_blank"><i class="material-icons">arrow_forward</i><span>Visit website</span></a><br />' : null
				,'<a class="neu__iconlink" href="'.home_url().'/staff/'.str_replace(" ","-",strtolower($d->post_title)).'" title="Filter to show '.strtolower($d->post_title).' team"><i class="material-icons">people</i><span>View Leadership</span></a>'
            );
			$departments .= '<section class="nu__slt">'.$department.'</section>';
		}
    }






    
    // department filter set (query var) -- only show data relevent to that department
    // this code will run on the staff page when a filter other than senior leadership is clicked
    // it can also be run on the department detail page ( must be manually set / passed ) 
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
        // 
		$args = array(
			 "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				 'relation' => 'AND'
                ,array(
                    "key"=>"department"
                    ,"value"=>'"'. $dept[0]->ID .'"'
                    ,"compare"=>"LIKE"
                )
                ,array(
                    "key"=>"department_head"
                    ,"value"=>"1"
                    ,"compare"=>"="
                )
			)
        );
        $manager = get_posts($args);

        // If we found a Department Head for this Department...
        if( !empty($manager) ){
            
            $managerFields = get_fields($manager[0]->ID);
            // set guide for writing the department head
            $guide = '
                <section class="nu__team">
                    <article>
                        <div>
                            <p class="description">%s</p>
                            <p>%s</p>
                            <p class="contact"><a class="neu__iconlink" href="tel:%s" title="Call %s">%s</a></p>
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
                ,( $currentPage === 'department-detail' ) ? '<a title="View full Profile [Opens in an Overlay]" class="js__bio neu__iconlink" href="/staff/bio/'.$manager[0]->post_name.'">View Full Profile</a>' : null 
                ,$managerFields['phone']
                ,strtolower($dept[0]->post_title)
                ,$managerFields['phone']
                ,( !empty($managerFields['url']) ) ? '<a class="neu__iconlink" href="'.$managerFields['url'].'" title="Visit '.strtolower($managerFields['department']->post_title ).' website [will open in new window]" target="_blank">Visit website</a>' : null
                ,$managerFields['headshot']['url']
                ,$manager[0]->post_title
                ,$managerFields['title']
            );
            $departments .= $department;
        }

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

        $guide = '
            <li>
                <div style="background-image: url(%s)"></div>
                <p>
                    <span>%s</span><br />
                    <span>%s</span><br />
                </p>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                %s
            </li>
        ';
        
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
                ,( !empty($fields['expert_at'])) ? 'Expert at: '.$fields['expert_at'] : null
                ,( !empty($fields['phone']) ) ? '<a class="neu__iconlink" href="tel:'. $fields['phone'] .'">'.$fields['phone'].'</a>' : null
                ,( !empty($fields['email']) ) ? '<a class="neu__iconlink" href="mailto:'. $fields['email'] .'">email</a>' : null
                ,( $currentPage === 'department-detail' && !empty($fields['description']) ) ? '<a href="/staff/bio/'.$member->post_name.'" title="View full Profile [Opens in an Overlay]" class="js__bio neu__iconlink">View Full Profile</a>' : null
			);
		}
		$departments .= "</ul></section>";
	}
	echo $departments;
?>
