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
                            %s
                            %s
                            %s
                            %s
                        </div>
                        <div>
                            <div style="background-image: url(%s);"></div>
                            <p><span>%s</span><br />%s</p>
                        </div>
                    </article>
                </section>
            ';
            // formatted string of department head content
            $content_depthead = '';
            $content_depthead .= sprintf(
                $format_depthead
                ,$department[0]->post_title
                ,( !empty($depthead_fields['description']) ) 
                    ? '<p class="description">'.wp_trim_words($depthead_fields['description'], 55, ' ...').'' 
                    : null
                ,( !empty($depthead_fields['description']) && str_word_count($depthead_fields['description']) >= 55 ) 
                    ? '<p><a class="js__bio neu__iconlink" href="/staff/bio/'.$depthead[0]->post_name.'">View Full Profile</a></p>' 
                    : null
                ,( !empty($depthead_fields['phone']) ) 
                    ? '<p class="contact"><a class="neu__iconlink" href="tel:'.$depthead_fields['phone'].'" title="Call '.$department[0]->post_title.'">'.$depthead_fields['phone'].'</a></p>' 
                    : null
                ,( !empty($depthead_fields['url']) )
                    ? '<p><a class="neu__iconlink" href="'.$depthead_fields['url'].'" title="Visit '.strtolower($depthead_fields['department']->post_title ).'" target="_blank">Visit Website</a></p>'
                    : null
                ,$depthead_fields['headshot']['url']
                ,$depthead[0]->post_title
                ,$depthead_fields['title']
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


            $content_deptstaff = '<section class="nu__team-list"><h3>Staff</h3><ul>';
            
            $format_deptstaff = '
                <li>
                    <div style="background-image: url(%s)"></div>
                    <p>
                        <span>%s</span><br />
                        <span>%s</span><br />
                    </p>
                    <p>%s</p>
                    <p>%s</p>
                    <p>%s</p>
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
                        ? '<a class="neu__iconlink" href="tel:'.$staffmember_fields['phone'].'" title="Call '.$staffmember->post_title.'">'.$staffmember_fields['phone'].'</a>' 
                        : null
                    ,( !empty($staffmember_fields['email']) )
                        ? '<a class="neu__iconlink" href="mailto:'.$staffmember_fields['email'].'" title="email '.$staffmember->post_title.'">email</a>'
                        : null
                    ,( !empty($staffmember_fields['description']) )
                        ? '<a class="neu__iconlink js__bio" href="/staff/bio/'.$staffmember->post_name.'" title="View Full Profile [opens in overlay]">View Full Profile</a>'
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