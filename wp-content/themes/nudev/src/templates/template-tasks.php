<?php 
/**
 * Template Name: Tasks
 */
    // Get: Task CPT Relevant Query Vars    
    // $fChk = $wp_query->query_vars['taskname'];
    // $slugTag = (isset($fChk) && $fChk != ''?$fChk:'');

    // // if a tag is set,
    // if( !empty($slugTag) ){
    //     // use tag as slug for query posts
    //     $args = array(
    //         'name' => $slugTag,
    //         'post_type' => 'tasks',
    //         'meta_query' => array(
    //             array(
    //                 'key' => 'task-status',
    //                 'value' => '1',
    //                 'compare' => '='
    //             )
    //         )
    //     );
    //     $task = query_posts($args)[0];
    //     // if there is a post object w/ this slug
    //     if( empty( $task ) ){
    //         $invalid = true;
    //     }
    // } else {
    //     $invalid = true;
    // }

    // if( $invalid === true ){
    //     wp_redirect('/');
    //     exit();
    // }

    
    // Get: Query Vars
    $task_name = $wp_query->query_vars['taskname'];
    $task_category = $wp_query->query_vars['taskcat'];

    // Verify: Correct URL structure
    // ( home_url/tasks/$task_category/$task_name )
    if( !$task_category || !$task_name || $task_name == 'null' ){
        // Do: Redirect to Home if invalid URL
        wp_redirect( home_url() );
        exit();
    }

    // Get: Posts (just one, by $task_name)
    $args = array(
        'name' => $task_name,
        'post_type' => 'tasks',
        'posts_per_page' => 1,
        'meta_query' => array(
            array(
                'key' => 'task-status',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    // Get: This Task
    $task = get_posts($args)[0];
    // If no Post was Returned (possibly it is inactive, or there is a problem)
    if( empty($task) ){
        // Do: Redirect to Home if invalid URL
        wp_redirect( home_url() );
        exit();
    }
    
    $fields = get_fields($task);

    // Verify: $task_name belongs to the $task_category in the CMS
    if( $fields['category'][0]->post_name !== $task_category ){
        // Do: Redirect to Home if invalid URL
        wp_redirect( home_url() );
        exit();
    }
    get_header();
 ?>
<main id="task" role="main" aria-label="content">
    <?php 
        // Required Page Sections :
        include(locate_template('loops/loop-task-main.php'));
        
        include(locate_template('loops/loop-task-optiongroup.php'));

        // Optional Page Sections :
        if( !empty($fields['faqs']) ){
            include(locate_template('loops/reusable/loop-faqs.php'));
        }
        if( !empty($fields['helpers']) ){
            include(locate_template('loops/reusable/loop-heretohelp.php'));
        }
        if( $fields['use_pre-footer'] == '1' ){
            include(locate_template('includes/prefooter.php'));
        }
        if( !empty($fields['related_tasks'])  ) {
            include(locate_template('includes/related-tasks.php'));
        }
     ?>
</main>
<?php 
    get_footer();
 ?>
