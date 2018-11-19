<?php 
/**
 * Important Deadlines Loop
 */

    $deadlines = get_fields($post)['deadlines'];

    // status, excerpt, link, external, start, end
    $format_deadline = '
        <li>
            <h1>%s</h1>
            <div>%s</div>
            <p>%s</p>
        </li>
    ';
    $content_deadline = '<ul id="deadlines">';
    foreach( $deadlines as $deadline ){

        if( $deadline['status'] ){


            $content_deadline .= sprintf(
                $format_deadline
                ,$deadline['title']
                ,$deadline['excerpt']
                ,$deadline['date']
            );
            
            
        }
        
    }
    $content_deadline .= '</ul>';

    echo $content_deadline;
?>