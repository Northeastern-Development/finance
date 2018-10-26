<?php 
/**
 * Template Name: Tasks
 * 
 * Description:
 *  The Tasks Template handles any pages related to the Tasks CPT
 */
    wp_reset_query();

    // get / set the rewrite tag ( expects a valid slug )
    $fChk = $wp_query->query_vars['taskname'];
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

    get_header();
    
    $taskFields = get_fields($task);

 ?>
<main id="task" role="main" aria-label="content">
    <?php 
        // Required Page Sections :
        include(locate_template('loops/loop-task-main.php'));
        
        include(locate_template('loops/loop-task-optiongroup.php'));

        // Optional Page Sections :
        if( !empty($taskFields['faq']) ){
            include(locate_template('loops/loop-task-faqs.php'));
        }
        if( !empty($taskFields['helpers']) ){
            include(locate_template('loops/reusable/loop-heretohelp.php'));
        }
        if( $taskFields['use_pre-footer'] !== 1 ){
            include(locate_template('includes/prefooter.php'));
        }
        if( !empty($taskFields['related_tasks'])  ) {
            include(locate_template('includes/related-tasks.php'));
        }
     ?>
</main>
<?php 
    get_footer();
 ?>
