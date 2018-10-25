<?php 

    $content = '<h2>Related Tasks</h2><ul>';
    $guide = '<a href="%s"><li>%s</li></a>';
    foreach ($taskFields['related_tasks'] as $i => $relTask) {

        $fields = get_fields($relTask['task']->ID);
        
        $path = $fields['category'][0]->post_name . '/' . $relTask['task']->post_name;

        $modifiedurl =  home_url($path);
        
        
        $content .= sprintf(
            $guide
            , $modifiedurl
            , $relTask['task']->post_title
        );
    }
    $content .= '</ul>';

    echo $content;

?>