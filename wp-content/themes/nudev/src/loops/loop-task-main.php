<?php
    $format = '<div class="task-heading"><h1>%s</h1>%s</div>';

    $content = sprintf(
        $format
        ,$task->post_title
        ,(isset($fields['description'])) ? $fields['description'] : null
    );

    echo $content;
 ?>
