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
        <h1>%s</h1>
        <div>%s</div>
        <p>%s</p>
        <p>%s</p>
    ';

    // the department content ( not staff, department )
    // sprintf content
    $content_department .= sprintf(
        $format_department
        ,$department[0]->post_title
        ,( !empty($fields['overview']) ) ? $fields['overview'] : null
        ,( !empty($fields['phone']) ) ? $fields['phone'] : null
        ,( !empty($fields['email']) ) ? $fields['email'] : null
    );

    // begin page
    get_header();
 ?>
<main role="main">

    <?php 
        $fields = get_fields($post_id);
        $base_title = $department[0]->post_title;
        // get hero space if enabled
        if( $fields['use_hero'] == '1' ){
            include(locate_template('includes/pagehero.php'));
        }
     ?>
    
    <section>
        <?php 
            echo $content_department;
         ?>
        <!-- <div class="main"> -->
            <?php 
                $filter = get_query_var('department');
                include locate_template('loops/loop-staff.php');
             ?>
        <!-- </div> -->
    </section>

    <section>
        <h1>Forms</h1>
        <?php 
            include(locate_template('loops/loop-forms.php'));
         ?>
    </section>

    <section class="tools">
        <h1>Tools</h1>
        <?php 
            include(locate_template('loops/reusable/loop-tools.php'));
         ?>
    </section>

    <section class="tasks">
        <h1>Tasks</h1>
        <?php 
            include(locate_template('loops/reusable/loop-tasks.php'));
         ?>
    </section>


</main>
<?php 
    get_footer();
 ?>