<?php

    $content = '<div class="relatedtasks"><h2>Related Tasks</h2><ul>';
    $guide = '<a href="%s" target="_blank" title="View this Related Task"><li>%s</li></a>';
    foreach ($fields['related_tasks'] as $i => $relTask) {

        $taskFields = get_fields($relTask['task']->ID);

        $path = 'tasks/'.$taskFields['category'][0]->post_name . '/' . $relTask['task']->post_name;

        $modifiedurl =  home_url($path);


        $content .= sprintf(
            $guide
            , $modifiedurl
            , $relTask['task']->post_title
        );
    }
    $content .= '</ul></div>';

    echo $content;

?>
