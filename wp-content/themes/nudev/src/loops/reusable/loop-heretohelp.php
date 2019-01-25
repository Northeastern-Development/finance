<?php
/**
 * 
 */

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }


    $content = '<h2>We are Here to Help</h2><ul class="h2h-items">';

    $guide = '
        <li class="h2h-items-item">
            <div class="neu__bgimg"><div style="background-image:url(%s)"></div></div>
            %s
            %s
            %s
            %s
            <br>
            %s
        </li>
    ';



    // Handle getting/setting the email subject based on the page template
    if( get_page_template_slug($post_id) == 'templates/template-tasks.php' ){
        $subject = $task->post_title;
    } else {
        $subject = $post->post_title;
    }

    // loop thru the 'helpers' post objects (they are staff cpt posts)
    foreach($fields['helpers'] as $i => $helper){



        $subfields = get_fields($helper['helper']->ID);

        $content .= sprintf(
            $guide
            ,$subfields['headshot']['url']
            , (isset($helper['helper']->post_title)) 
                ? '<h4>'.$helper['helper']->post_title.'</h4>' 
                : null // post_title is name of staff member
            , (isset( $subfields['department'][0] )) 
                ? '<p>'.$subfields['department']->post_title.'</p>' 
                : null // associated department
            , (isset( $subfields['title'] )) 
                ? '<p>'.$subfields['title'].'</p>' 
                : null // staff member official title (not post title)
            , (isset( $subfields['phone'] )) 
                ? '<a class="neu__iconlink" href="tel:'.$subfields['phone'].'" title="Click to dial number (may open new window)" target="_blank">'.$subfields['phone'].'</a>' 
                : null // phone #
            , (isset( $subfields['email'] )) 
                ? '<a title="Click to email '.$helper['helper']->post_title.'" class="neu__iconlink" href="mailto:'.$subfields['email'].'?subject='.$subject.'">email</a>' 
                : null // email
        );
    }
    // close out the ul and the section
    $content .= '</ul>';

    echo $content;
?>
