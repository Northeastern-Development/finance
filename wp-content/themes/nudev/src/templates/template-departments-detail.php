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
    <section>
        <?php 
            echo $content_department;
         ?>
        <div class="main">
            <?php 
                // note: div.main is required markup wrapper to enable the lightbox overlay!
                // main#pagename > section > div.main is nonsense and should probably change

                // loop-staff is used on both the dedicated staff page and the department detail page
                // we set the required $filter var here, and track the page template we are on to determine the loop-staff behavior
                $filter = get_query_var('department');
                // include the staff loop (per department)
                include locate_template('loops/loop-staff.php');
             ?>
        </div>
    </section>
</main>
<?php 
    get_footer();
 ?>