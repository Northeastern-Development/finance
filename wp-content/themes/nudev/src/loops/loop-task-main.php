<?php 
    $format = "<section><h1>%s</h1>%s</section>";

    $content = sprintf(
        $format
        ,$task->post_title
        ,(isset($taskFields['description'])) ? $taskFields['description'] : null
    );
    
    echo $content;
 ?>