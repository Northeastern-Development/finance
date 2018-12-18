<?php

    $content = '
        <h2>Related Tasks</h2>
        <ul class="cols-2">
    ';
    
    $guide = '
        <li>
            <i class="material-icons">arrow_forward</i><a href="%s" target="_blank" title="View this Related Task">%s</a>
        </li>
    ';
    
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
    $content .= '
            </ul>
    ';

    echo $content;
?>
