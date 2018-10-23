<?php 
    $format = "<h1>%s</h1>%s";
    $content = sprintf($format, $task->post_title, $taskFields['description']);
    echo $content;
 ?>