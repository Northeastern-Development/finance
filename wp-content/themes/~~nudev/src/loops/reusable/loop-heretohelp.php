<?php
/**
 * 
 */

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }


    $content = '<h2>We Are Here to Help</h2><ul class="h2h-items">';

    $guide = '
        <li class="h2h-items-item">
            <div class="neu__bgimg"><div style="background-image:url(%s)" aria-label="%s\'s profile picture"></div></div>
            <div>
                %s
                %s
                %s
                %s
                <br>
                %s
            </div>
        </li>
    ';



    // Handle getting/setting the email subject based on the page template
    if( get_page_template_slug($post_id) == 'templates/template-tasks.php' ){
        $subject = $task->post_title;
    } else {
        $subject = $post->post_title;
    }

    $count = 0;

    // loop thru the 'helpers' post objects (they are staff cpt posts)
    foreach($fields['helpers'] as $i => $helper){

        $subfields = get_fields($helper['helper']->ID);

        if( !empty($subfields['status']) ){

            $count++;
            
            $content .= sprintf(
                $guide
                ,$subfields['headshot']['url']
                ,$helper['helper']->post_title
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
                    ? '<a class="neu__iconlink" href="tel:'.$subfields['phone'].'" title="Call '.$helper['helper']->post_title.'" aria-label="Call '.$helper['helper']->post_title.'">'.$subfields['phone'].'</a>' 
                    : null // phone #
                , (isset( $subfields['email'] )) 
                    ? '<a class="neu__iconlink" href="mailto:'.$subfields['email'].'?subject='.$subject.'" title="Email '.$helper['helper']->post_title.'" aria-label="Email '.$helper['helper']->post_title.'">email</a>' 
                    : null // email
            );
        }


    }
    // close out the ul and the section
    $content .= '</ul>';

    if( $count > 0 ){
        echo $content;
    }
?>
