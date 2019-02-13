<?php 
/**
 * Template Name: Departments Index Page
 */
$args = array(
    'post_type' => 'departments',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'status',
            'value' => '1',
            'compare' => '='
        )
    )
);
$departments = get_posts($args);


$format_department = '
    <a href="%s"><h1>%s</h1></a>
';
$content_department = '';

foreach( $departments as $department ){
    $permalink = site_url('/departments/' . $department->post_name );
    $content_department .= sprintf(
        $format_department
        ,$permalink
        ,$department->post_title
    );
}

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