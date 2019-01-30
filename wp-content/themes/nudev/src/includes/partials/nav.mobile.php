<?php
/**
 * Mobile Nav
 */

   // get task categories
    $args = array(
        'post_type'         =>  'tasks_categories',
        'posts_per_page'    =>  -1,
        'meta_query'        => array(
            array(
                'key'       => 'status', // (we can always just set this to 'status', but need to verify change everywhere)
                'value'     => '1',
                'compare'   => '='
            )
        )
    );
    $cats = get_posts($args);
    
    
    $format_cats = '
        <li>
            <a class="toggle js-mobile-nav child" href="#">%s</a>
            <div class="inner">
                <ul>
                    %s
                </ul>
            </div>
        </li>
    ';
    $format_tasks = '<li><a href="%s">%s</a></li>';
    foreach( $cats as $cat ){
        // get all active tasks within this category
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
        $content_tasks = '';
        foreach( $tasks as $task ){
            $content_tasks .= sprintf(
                $format_tasks
                ,site_url('/tasks/').$cat->post_name.'/'.$task->post_name
                ,$task->post_title
            );
        }
        $content_cats .= sprintf(
            $format_cats
            ,$cat->post_title
            ,$content_tasks
        );
    }
?>
<div id="nu__mobile">
    <nav>
        <ul>
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:void(0);">How do I..</a>
                <ul class="inner">
                    <?php echo $content_cats; ?>    
                </ul>
            </li>
            <?php 
                $nav_links = array(
                    'Forms' => get_permalink( get_page_by_path('forms') ),
                    'Tools' => get_permalink( get_page_by_path('tools') ),
                    'Expense Codes' => get_permalink( get_page_by_path('expense-codes') )
                );
                $format_nav_links = '<li><a href="%s">%s</a></li>';
                $content_nav_links = '';
                foreach( $nav_links as $title => $permalink ){
                    $content_nav_links .= sprintf(
                        $format_nav_links
                        ,$permalink
                        ,$title
                    );
                }
                echo $content_nav_links;
            ?>
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:void(0);">About</a>
                <ul class="inner">
                    <?php 
                        $format_about_submenu_links = '<li><a href="%s">%s</a></li>';
                        $about_submenu_links = array(
                            'Department &amp; Staff Information' => get_permalink( get_page_by_path('about') ),
                            'Contact Us' => get_permalink( get_page_by_path('contact') )
                        );
                        $content_about_submenu_links = '';
                        foreach( $about_submenu_links as $title => $permalink ){
                            $content_about_submenu_links .= sprintf(
                                $format_about_submenu_links
                                ,$permalink
                                ,$title
                            );
                        }
                        echo $content_about_submenu_links;
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
</div>