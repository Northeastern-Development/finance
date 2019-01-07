<?php 
/**
 * Partial: navigation sub-nav  "How Do I..."
 */
    // 
    $args = array(
        'post_type'         =>  'tasks_categories',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       => 'status',
                'value'     => '1',
                'compare'   => '='
            )
        )
    );
    $cats = get_posts($args);

    $format_cats = '
        <div>
            <img class="taskicon" src="%s">
            <h4>%s</h4>
            <ul>
                %s
            </ul> 
        </div>
    ';
    $format_tasks = '
        <li>
            <a href="%s">%s</a>
        </li>
    ';
    $content_cats = '';
    foreach ($cats as $i => $cat) {

        $fields = get_fields($cat->ID);

        // GET active tasks within this category
        $args = array(
            'post_type' => 'tasks',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => '1',
                    'compare' => '='
                ),
                array(
                    'key' => 'category',
                    'value' => $cat->ID,
                    'compare' => 'LIKE'
                )
            )
        );
        $tasks = get_posts($args);

        // SET TASKS STRING
        $content_tasks = '';
        foreach( $tasks as $i => $task ){
            $content_tasks .= sprintf(
                $format_tasks
                ,site_url('/tasks/') . $cat->post_name.'/'.$task->post_name
                ,$task->post_title
            );
        }

        // SET CATS STRING
        $content_cats .= sprintf(
            $format_cats
            ,$fields['icon']
            ,$cat->post_title
            ,$content_tasks
        );
    }
?>
<div class="neumenu-wrapper-inner">
    <div>
        <h2>How Do I...</h2>
        <h3>(Select Topic)</h3>
        <h3>(Select Task)</h3>
        <h3 class="removefilter">Back to Topics</h3>
    </div>
    <div>
        <?php 
            echo $content_cats;
        ?>
    </div>
</div>