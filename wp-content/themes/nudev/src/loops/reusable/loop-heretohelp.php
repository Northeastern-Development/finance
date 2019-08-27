<?php
/**
 *  Reusable Loop:
 *  "here to help" section,
 *  is the same thing as the staff grid, -- nu__team-list
*/

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }

    $content = '<h2>We Are Here to Help</h2><ul>';

    // 
    $guide = '
        <li>
            <div class="neu__bgimg"><div style="background-image: url(%s)" aria-label="%s\'s profile picture"></div></div>
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
                ,$helper['helper']->post_title
                ,$subfields['title']
                ,( !empty($subfields['phone']) ) 
                    ? '<a class="neu__iconlink" href="tel:'.$subfields['phone'].'" aria-label="Call '.$helper['helper']->post_title.'" title="Call '.$helper['helper']->post_title.'">'.$subfields['phone'].'</a>' 
                    : null
                ,( !empty($subfields['email']) )
                    ? '<a class="neu__iconlink" href="mailto:'.$subfields['email'].'" aria-label="Email '.$helper['helper']->post_title.'" title="Email '.$helper['helper']->post_title.'">email</a>'
                    : null
                ,( !empty($subfields['description']) )
                    ? '<a class="neu__iconlink js__bio" href="/staff/bio/'.$helper['helper']->post_name.'" aria-label="View '.$helper['helper']->post_title.'\'s full profile" title="View '.$helper['helper']->post_title.'\'s full profile">View full profile</a>'
                    : null
            );
        }
    }
    // close out the ul and the section
    $content .= '</ul>';

    if( $count > 0 ){
        echo $content;
    }
?>
