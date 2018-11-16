<?php 
/**
 * Template Name: Department Detail Page
 */

    $filter = get_query_var('department');

    $args = array(
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

    $fields = get_fields( $department[0]->ID );

    $format_department = '
        <h1>%s</h1>
        <div>%s</div>
        <p>%s</p>
        <p>%s</p>
    ';
    $content_department .= sprintf(
        $format_department
        ,$department[0]->post_title
        ,( !empty($fields['overview']) ) ? $fields['overview'] : null
        ,( !empty($fields['phone']) ) ? $fields['phone'] : null
        ,( !empty($fields['email']) ) ? $fields['email'] : null
    );

    get_header();
 ?>
<main role="main">
    <section>
        <?php echo $content_department; ?>
    </section>
</main>
<?php 
    get_footer();
 ?>