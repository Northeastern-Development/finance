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
    
    
 ?>
<main id="task" role="main" aria-label="content">

    

    <?php 
        include(locate_template('loops/loop-task-main.php'));
     ?>

    <?php 
        include(locate_template('loops/loop-task-optiongroup.php'));
     ?>

    <?php 
        include(locate_template('loops/loop-task-faqs.php'));
     ?>
    

</main>
<?php 
    get_footer();
 ?>
