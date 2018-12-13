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
            <p>%s</p>
            <div>%s</div>
        </li>
    ';
    $content_deadline = '
        <div class="home-deadlines">
            <h4>Upcoming Deadlines</h4>
            <ul class="home-deadlines-items">
    ';

    foreach( $deadlines as $i => $deadline ){
        if( $i < 5 ){

            if( $deadline['status'] == '1' && $deadline['date'] > date('Ymd') ){
                
                
                $content_deadline .= sprintf(
                    $format_deadline
                    ,date('M d' ,strtotime($deadline['date']))
                    ,$deadline['title']
                    ,$deadline['excerpt']
                );
                
            }
            
        }
    }
    $content_deadline .= '</ul></div>';

    echo $content_deadline;

?>