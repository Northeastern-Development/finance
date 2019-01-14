<?php 
/**
 * Important Deadlines Loop
 */

    $deadlines = get_fields($post)['deadlines'];
    
    usort($deadlines, function($a, $b){
        return $a['date'] <=> $b['date'];
    });

    // status, excerpt, link, external, start, end
    $format_deadline = '
        <li>
            <h5>%s</h5>
            %s
        </li>
    ';
    $content_deadline = '
        <div class="deadlines">
            <div>
                <h4>Upcoming Deadlines</h4>
                <ul class="deadlines-items">
    ';
    $total = 0;
    foreach( $deadlines as $i => $deadline ){
        if( $i < 5 ){
            if( $deadline['status'] == '1' && $deadline['date'] >= date('Ymd') ){                
                $content_deadline .= sprintf(
                    $format_deadline
                    ,date('M d' ,strtotime($deadline['date']))
                    ,$deadline['excerpt']
                );
                $total++;
            }
        }
    }
    
    $content_deadline .= '
                </ul>
            </div>
        </div>
    ';

    if( $total > 0 ){
        echo $content_deadline;
    }
?>