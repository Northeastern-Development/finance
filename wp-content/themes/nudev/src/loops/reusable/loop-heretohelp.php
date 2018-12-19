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
            <figure style="background-image:url(%s)"></figure>
            %s
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
            , (isset($helper['helper']->post_title)) ? '<p>'.$helper['helper']->post_title.'</p>' : null // post_title is name of staff member
            , (isset( $subfields['department'][0] )) ? '<p>'.$subfields['department']->post_title.'</p>' : null // associated department
            , (isset( $subfields['title'] )) ? '<p>'.$subfields['title'].'</p>' : null // staff member official title (not post title)
            , (isset( $subfields['expert_at'] )) ? '<p> Expert at: '.$subfields['expert_at'].'</p>' : null // expert at
            , (isset( $subfields['phone'] )) ? '<a href="tel:'.$subfields['phone'].'" title="Click to dial number (may open new window)" target="_blank"><i class="material-icons">phone</i>'.$subfields['phone'].'</a>' : null // phone #
            , (isset( $subfields['email'] )) ? '<a href="mailto:'.$subfields['email'].'?subject='.$subject.'"><i class="material-icons">email</i>e-mail</a>' : null // email
        );
    }
    // close out the ul and the section
    $content .= '</ul>';

    echo $content;
?>
