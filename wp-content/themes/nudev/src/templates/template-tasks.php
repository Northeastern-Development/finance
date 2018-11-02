<?php 
/**
 * Template Name: Tasks
 */
    // Get: Task CPT Relevant Query Vars    
    $fChk = $wp_query->query_vars['taskname'];

    print_r($cat);
    print_r($fChk);

    $slugTag = (isset($fChk) && $fChk != ''?$fChk:'');

    // if a tag is set,
    if( !empty($slugTag) ){
        // use tag as slug for query posts
        $args = array(
            'name' => $slugTag,
            'post_type' => 'tasks',
            'meta_query' => array(
                array(
                    'key' => 'task-status',
                    'value' => '1',
                    'compare' => '='
                )
            )
        );
        $task = query_posts($args)[0];
        // if there is a post object w/ this slug
        if( empty( $task ) ){
            $invalid = true;
        }
    } else {
        $invalid = true;
    }

    if( $invalid === true ){
        wp_redirect('/');
        exit();
    }



    $task_name = $wp_query->query_vars['taskname'];
    $task_category = $wp_query->query_vars['taskcat'];


    get_header();
    
    $fields = get_fields($task);

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
