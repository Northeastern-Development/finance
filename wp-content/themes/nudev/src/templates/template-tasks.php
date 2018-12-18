<?php
/**
 * Template Name: Tasks
 */

    // Get: Query Vars
    $task_name = $wp_query->query_vars['taskname'];
    $task_category = $wp_query->query_vars['taskcat'];

    // Verify: Correct URL structure
    // ( home_url/tasks/$task_category/$task_name )
    // Do: Redirect to Home if invalid URL
    if( !$task_category || !$task_name || $task_name == 'null' ){
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
                'key' => 'status',
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


    get_header();
 ?>
<main class="main">
    <?php
        // page hero
        $fields = get_fields($post_id);          
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields, $task->post_title, get_fields($task)['description']);

        $fields = get_fields($task); // (inefficient)
    ?>
  
   <section>
       <?php include(locate_template('loops/loop-task-optiongroup.php')); ?>
   </section>
   
   <section>
       <?php 
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }
        ?>
   </section>

   <section class="here2help">
       <?php 
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
   </section>

   <section>
       <?php 
            if( $fields['use_pre-footer'] == '1' ){
                include(locate_template('includes/prefooter.php'));
            }
        ?>
   </section>

   <section class="related-tasks">
       <?php 
            if( !empty($fields['related_tasks'])  ) {
                include(locate_template('includes/related-tasks.php'));
            }
       ?>
   </section>
</div>
<?php
    get_footer();
 ?>
