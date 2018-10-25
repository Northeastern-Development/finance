<?php 
/**
 * Here To Help Reusable Section
 */

    // Open a section and a ul
    $content = '<section id="heretohelp"><ul class="h2h-items">';

    // Set the sprintf guide to create line items
    $guide = '<li class="h2h-items-item"><img class="h2h-items-item-img" src="%s"><p>%s</p><p>%s</p><p>%s</p><p>%s</p><a href="tel:%s"><p>%s</p></a><a href="mailto:%s"><p>%s</p></li>';

    // loop thru the 'helpers' post objects (they are staff cpt posts)

    foreach($taskFields['helpers'] as $i => $helper){

        $fields = get_fields($helper['helper']->ID);

        $content .= sprintf(
            $guide
            ,$fields['headshot']['url']
            ,$helper['helper']->post_title
            ,$fields['department'][0]
            ,$fields['title']
            ,$fields['expert_at']
            ,$fields['phone']
            ,$fields['phone']
            ,$fields['email']
            ,$fields['email']
        );
    }
    // close out the ul and the section
    $content .= '</ul></section>';

    echo $content;
?>