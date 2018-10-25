<?php 
    $format = "<section><h1>%s</h1>%s</section>";
    $content = sprintf($format, $task->post_title, $taskFields['description']);
    echo $content;
 ?>