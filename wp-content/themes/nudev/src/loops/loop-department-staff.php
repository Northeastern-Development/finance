<?php 

    // determine currently loaded department
    $filter = get_query_var('department');
    // get the department post
    $args = array(
        'post_type' => 'departments'
        ,'name' => $filter
        ,'posts_per_page' => 1
    );
    $department = get_posts($args);
    // get the department fields
    $fields = get_fields($department[0]);
    // verify data exists
    if( !empty($department) ){
        
        // get department head
        $args = array(
            "post_type" => "staff"
            ,"posts_per_page" => -1
            ,'meta_query' => array(
                'relation' => 'AND'
                ,array(
                    "key"=>"department"
                    ,"value"=>'"'. $department[0]->ID .'"'
                    ,"compare"=>"LIKE"
                )
                ,array(
                    "key"=>"department_head"
                    ,"value"=>"1"
                    ,"compare"=>"="
                )
            )
        );
        $depthead = get_posts($args);
        // verify department head data exists
        if( !empty($depthead) ){
            // get department head fields
            $depthead_fields = get_fields($depthead[0]);
            // formatting string for department head content
            $format_depthead = '
                <section class="nu__team">
                    <h2>%s Team</h2>
                    <article>
                        <div>
                            <h3>%s</h3>
                            <h6>%s</h6>
                            %s
                            %s
                            %s
                            %s
                        </div>
                        <div class="neu__bgimg">
                            <div style="background-image: url(%s);"></div>
                        </div>
                    </article>
                </section>
            ';
            // formatted string of department head content
            $content_depthead = '';
            $content_depthead .= sprintf(
                $format_depthead
                ,$department[0]->post_title
                ,$depthead[0]->post_title
                ,$depthead_fields['title']
                ,( !empty($depthead_fields['description']) )
                    ? '<p><a aria-label="View '.$depthead[0]->post_title.'\'s full profile" title="View '.$depthead[0]->post_title.'\'s full profile" class="js__bio neu__iconlink" href="/staff/bio/'.$depthead[0]->post_name.'">View full profile</a></p>'
                    : null
                ,( !empty($depthead_fields['phone']) ) 
                    ? '<p><a class="neu__iconlink neu__iconlink-phone" href="tel:'.$depthead_fields['phone'].'" aria-label="Call '.$depthead[0]->post_title.'" title="Call '.$depthead[0]->post_title.'">'.$depthead_fields['phone'].'</a></p>' 
                    : null
                ,( !empty($depthead_fields['email']) ) 
                    ? '<p><a class="neu__iconlink neu__iconlink-email" href="mailto:'.$depthead_fields['email'].'" aria-label="Email '.$depthead[0]->post_title.'" title="Email '.$depthead[0]->post_title.'">email</a></p>' 
                    : null
                ,( !empty($depthead_fields['url']) )
                    ? '<p><a class="neu__iconlink neu__iconlink-url" href="'.$depthead_fields['url'].'" aria-label="Visit '.strtolower($depthead_fields['department']->post_title ).'" title="Visit '.strtolower($depthead_fields['department']->post_title ).'" target="_blank">Visit Website</a></p>'
                    : null
                ,$depthead_fields['headshot']['url']
                
            );
            // verify department head content
            if( !empty($content_depthead) ){
                // print department head to page
                echo $content_depthead;
            }         
        } // end if we have a department head


        // get other staff than the department head
        $args = array(
            "post_type" => "staff"
			,"posts_per_page" => -1
			,'meta_query' => array(
				'relation' => 'AND'
                ,array(
                    "key"=>"department"
                    ,"value"=>'"'. $department[0]->ID .'"'
                    ,"compare"=>"LIKE"
                )
                ,array(
                    "key"=>"department_head"
                    ,"value"=>"0"
                    ,"compare"=>"="
                )
			)
        );
        $deptstaff = get_posts($args);

        // verify staff data exists
        if( !empty($deptstaff) ){


            $content_deptstaff = '<section class="nu__team-list fullwidth nobg"><h3>Staff</h3><ul>';
            
            $format_deptstaff = '
                <li>
                    <div class="neu__bgimg"><div style="background-image: url(%s)"></div></div>
                    <div>
                        <p>
                            <span>%s</span><br />
                            <span>%s</span><br />
                        </p>
                        <p>%s</p>
                        <p>%s</p>
                        <p>%s</p>
                    </div>
                </li>
            ';

            foreach( $deptstaff as $staffmember ){

                $staffmember_fields = get_fields($staffmember);
                
                $content_deptstaff .= sprintf(
                    $format_deptstaff
                    ,$staffmember_fields['headshot']['url']
                    ,$staffmember->post_title
                    ,$staffmember_fields['title']
                    ,( !empty($staffmember_fields['phone']) ) 
                        ? '<a class="neu__iconlink" href="tel:'.$staffmember_fields['phone'].'" aria-label="Call '.$staffmember->post_title.'" title="Call '.$staffmember->post_title.'">'.$staffmember_fields['phone'].'</a>' 
                        : null
                    ,( !empty($staffmember_fields['email']) )
                        ? '<a class="neu__iconlink" href="mailto:'.$staffmember_fields['email'].'" aria-label="Email '.$staffmember->post_title.'" title="Email '.$staffmember->post_title.'">email</a>'
                        : null
                    ,( !empty($staffmember_fields['description']) )
                        ? '<a class="neu__iconlink js__bio" href="/staff/bio/'.$staffmember->post_name.'" aria-label="View '.$staffmember->post_title.'\'s full profile" title="View '.$staffmember->post_title.'\'s full profile">View full profile</a>'
                        : null
                );
            }

            $content_deptstaff .= '</ul></section>';

            if( !empty($content_deptstaff) ){

                echo $content_deptstaff;

            }

        }
        
        
    } // end if we have a department
 ?>