<?php 

    $content = '<section class="relatedtasks"><h3>Related Tasks</h3><ul>';
    $guide = '<a href="%s" target="_blank" title="View this Related Task"><li>%s</li></a>';
    foreach ($taskFields['related_tasks'] as $i => $relTask) {

        $fields = get_fields($relTask['task']->ID);
        
        $path = 'tasks/'.$fields['category'][0]->post_name . '/' . $relTask['task']->post_name;

        $modifiedurl =  home_url($path);
        
        
        $content .= sprintf(
            $guide
            , $modifiedurl
            , $relTask['task']->post_title
        );
    }
    $content .= '</ul></section>';

    echo $content;

?>