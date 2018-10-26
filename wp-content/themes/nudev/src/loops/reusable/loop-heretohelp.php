<?php 
/**
 * Here To Help Reusable Section
 */

    $content = '<section id="heretohelp"><ul class="h2h-items">';

    $guide = '
        <li class="h2h-items-item">
        <img class="h2h-items-item-img" src="%s">
        %s
        %s
        %s
        %s
        %s
        %s
        </li>
    ';

    // loop thru the 'helpers' post objects (they are staff cpt posts)

    foreach($taskFields['helpers'] as $i => $helper){

        $fields = get_fields($helper['helper']->ID);

        $content .= sprintf(
            $guide
            ,$fields['headshot']['url']
            , (isset($helper['helper']->post_title)) ? '<p>'.$helper['helper']->post_title.'</p>' : null
            , (isset( $fields['department'][0] )) ? '<p>'.$fields['department'][0].'</p>' : null
            , (isset( $fields['title'] )) ? '<p>'.$fields['title'].'</p>' : null
            , (isset( $fields['expert_at'] )) ? '<p>'.$fields['expert_at'].'</p>' : null
            , (isset( $fields['phone'] )) ? '<a href="tel:'.$fields['phone'].'"><p>'.$fields['phone'].'</p></a>' : null
            , (isset( $fields['email'] )) ? '<a href="mailto:'.$fields['email'].'"><p>'.$fields['email'].'</p></a>' : null
        );
    }
    // close out the ul and the section
    $content .= '</ul></section>';

    echo $content;
?>