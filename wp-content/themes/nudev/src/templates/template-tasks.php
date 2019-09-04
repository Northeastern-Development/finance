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
        // echo PageHero::return_pagehero($fields, $task->post_title, get_fields($task)['description']);
        echo PageHero::return_pagehero($fields, $task->post_title, null);

        $fields = get_fields($task); // (inefficient)
    ?>
    <section class="task-intro">
        <?php 
            $blurb = get_fields($task)['description'];
            echo $blurb;
         ?>
    </section>
   <section class="task-solutions">
        <?php 
       
            if( !empty($fields['options_group']) ){

                include(locate_template('loops/loop-task-optiongroup.php'));
            }
       
         ?>
   </section>
   
   <section class="task-faqs">
       <?php 
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }
        ?>
   </section>

   <?php 
        if( $fields['use_pre-footer'] == '1' ){
            
            echo '<section class="prefooter">';
            include(locate_template('includes/prefooter.php'));
            echo '</section>';

        }
    ?>

   <section class="related-items">
       <?php 
            if( !empty($fields['related_tasks'])  ) {
                include(locate_template('includes/related-tasks.php'));
            }
       ?>
   </section>

    <section class="nu__team-list">
        <?php 
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
            ?>
</section>
</div>
<?php
    get_footer();
 ?>
