<?php 
/**
 * Template Name: Department Detail Page
 */
    //  check for department name query var
    $filter = get_query_var('department');
    // get 'this' department
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'departments',
        'name' => $filter,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $department = get_posts($args);
    // if an active department post cannot be found, redirect to the department index
    if( empty($department[0]) ){
        wp_redirect( home_url('/departments') );
    }
    // otherwise get the fields for this department
    $fields = get_fields( $department[0]->ID );
    // sprintf format
    $format_department = '
        %s
        <div>%s</div>
        %s
        %s
    ';
    // the department content ( not staff, department )
    // sprintf content
    $content_department .= sprintf(
        $format_department
        ,'<h2>Our Mission</h2>'
        ,( !empty($fields['overview']) ) ? '<div>'.$fields['overview'].'</div>' : null
        ,( !empty($fields['phone']) ) ? '<a class="neu__iconlink" title="Call '.$department[0]->post_title.'" href="tel:'.$fields['phone'].'">'.$fields['phone'].'</a>' : null
        ,( !empty($fields['email']) ) ? '<a class="neu__iconlink" title="Email '.$department[0]->post_title.'" href="mailto:'.$fields['email'].'">email</a>' : null
    );

    
    $args = array(
        'post_type' => 'tasks',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            // must be active
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            ),
            // must be assigned to 'this' department
            array(
                'key' => 'department',
                'value' => get_page_by_path($filter, OBJECT, 'departments')->ID,
                'compare' => 'LIKE'
            )
        )
    );
    $tasks = get_posts($args);
    $content_related_tasks = '';
    if( !empty($tasks) ){
        $format_related_tasks = '
            <li>
                <a class="neu__iconlink" href="%s" title="View %s">%s</a>
            </li>
        ';
        $content_related_tasks = '
            <h2>Related Tasks</h2>
            <ul>
        ';
        foreach( $tasks as $task ){
            $category = get_fields($task->ID)['category'][0]->post_name;
            $content_related_tasks .= sprintf(
                $format_related_tasks
                ,site_url('/tasks/').$category.'/'.$task->post_name
                ,$task->post_title
                ,$task->post_title
            );
            
        }
        $content_related_tasks .= '</ul>';
    }
    // END GET RELATED TASKS

    
    // BEGIN GET RELATED FORMS
    $args = array(
        'post_type' => 'forms',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'status',
                'value' => '1',
                'compare' => '='
            ),
            array(
                'key' => 'department',
                'value' => get_page_by_path(get_query_var('department'), OBJECT, 'departments')->ID,
                'compare' => 'LIKE'
            )
        ) 
    );
    $forms = get_posts($args);
    $content_related_forms = '';
    if( !empty($forms) ){
        $format_related_forms = '
            <li>
                <a class="neu__iconlink" href="%s" title="View %s">%s</a>
            </li>
        ';
        $content_related_forms = '<h2>Related Forms</h2><ul>';
        
        foreach( $forms as $form ){   
            $content_related_forms .= sprintf(
                $format_related_forms
                ,site_url().'/forms/'
                ,$form->post_title
                ,$form->post_title
            );
        }
        $content_related_forms .= '</ul>';
    }

    // END GET RELATED FORMS


    get_header();
 ?>
    <main role="main">
        <?php 
            // get fields for the generic department page ( verify 'use hero', nothing else )
            $fields = get_fields($post_id);
            if( $fields['use_hero'] == '1' ){
                echo PageHero::return_pagehero($fields, $department[0]->post_title);
            }
        ?>

        <?php 

            if( !empty($content_department) ){
                echo '<section class="dept_main">'.$content_department.'</section>';
            }

            if( !empty($content_related_tasks) ){
                echo '<section class="dept_reltasks">'.$content_related_tasks.'</section>';
            }
            
            if( !empty($content_related_forms) ){
                echo '<section class="dept_relforms">'.$content_related_forms.'</section>';
            }
            include locate_template('loops/loop-department-staff.php');
            
         ?>
    </main>
<?php 
    get_footer();
 ?>