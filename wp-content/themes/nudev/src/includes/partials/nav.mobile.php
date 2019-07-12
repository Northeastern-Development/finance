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
            <a class="toggle js-mobile-nav child" href="javascript:;" title="Expand the %s task category" aria-label="Expand the %s task category">%s</a>
            <div class="inner">
                <ul>
                    %s
                </ul>
            </div>
        </li>
    ';
    $format_tasks = '<li><a href="%s" title="View the %s task" aria-label="View the %s task">%s</a></li>';
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
                ,$task->post_title
                ,$task->post_title
            );
        }

        $content_cats = '';
        $content_cats .= sprintf(
            $format_cats
            ,$cat->post_title
            ,$cat->post_title
            ,$cat->post_title
            ,$content_tasks
        );
    }
?>
<div id="nu__mobile">
    <nav>
        <ul>
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:;" title="Expand the Task Categories" aria-label="Expand the Task Categories">How Do I..</a>
                <ul class="inner">
                    <?php echo $content_cats; ?>    
                </ul>
            </li>
            <?php 
                $nav_links = array(
                    'Forms' => get_permalink( get_page_by_path('forms') ),
                    'Tools' => get_permalink( get_page_by_path('tools') ),
                    'Banner Codes' => 'https://prod-web.neu.edu/wasapp/Banner/Finance/secure/index.jsp'
                );
                $format_nav_links = '<li><a %s href="%s" aria-label="View the %s page" title="View the %s page">%s</a></li>';
                $content_nav_links = '';
                foreach( $nav_links as $title => $permalink ){
                    $content_nav_links .= sprintf(
                        $format_nav_links
                        ,( $title === 'Banner Codes' ) ? 'target="_blank"' : null
                        ,$permalink
                        ,$title
                        ,$title
                        ,$title
                    );
                }
                echo $content_nav_links;
            ?>
            <li>
                <a class="toggle js-mobile-nav parent" href="javascript:void(0);" title="Expand the About dropdown" aria-label="Expand the About dropdown">About</a>
                <ul class="inner">
                    <?php 
                        $format_about_submenu_links = '<li><a href="%s" aria-label="View the %s page" title="View the %s page">%s</a></li>';
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
                                ,$title
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