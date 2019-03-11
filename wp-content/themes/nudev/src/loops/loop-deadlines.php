<?php 
    /**
     * Important Deadlines Loop
     */
    $args = array(
        'post_type'     => 'deadlines'
        ,'posts_per_page'   => 5
        ,'meta_query'   => array(
            'relation' => 'AND'
            ,array(
                'key'       => 'status',
                'value'     => '1',
                'compare'   => '='
            )
            ,array(
                'key' => 'date'
                ,'compare' => '>='
                ,'value' => date('Y-m-d')
                ,'type' => 'DATE'
            )
        )
        ,'orderby' => 'meta_value'
        ,'meta_key' => 'date'
        ,'order' => 'ASC'
    );

    $deadlines = get_posts($args);
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
    foreach( $deadlines as $deadline ){

        $fields = get_fields($deadline);

        // if( $fields['date'] >= date('Ymd') ){

            $content_deadline .= sprintf(
                $format_deadline
                ,date('M d' ,strtotime($fields['date']))
                ,$fields['details']
            );
        // }
    }
    $content_deadline .= '
                </ul>
            </div>
            <a href="/deadlines" class="nu__content_btn" title="View all deadlines" aria-label="View all deadlines">View all deadlines</a>
        </div>
    ';
    echo $content_deadline;

?>