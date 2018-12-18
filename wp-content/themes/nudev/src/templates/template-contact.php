<?php 
/**
 * Template Name: Contact Us
 */
    get_header();
 ?>
<main>
    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields, $toolpost['post_title'], null);
     ?>

    <section class="heretohelp">
        <?php 
             // Here2Help,
             if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
    </section>
    <section class="overview-depts">
        <h2>Departments and Staff</h2>

        <?php 
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

            $res = get_posts($args);
            
            $format_depts = '
                <li>
                    <i class="material-icons">arrow_forwards</i><h4>%s</h4>
                </li>
            ';

            foreach( $res as $rec ){
                $content_depts .= sprintf(
                    $format_depts
                    ,$rec->post_title
                );
            }
         ?>
        <ul>
            <?= $content_depts; ?>
        </ul>
        
    </section>

    <section>
        <?php 
            include(locate_template('loops/reusable/loop-faqs.php'));
         ?>
    </section>
     

</main>
<?php 
    get_footer();
 ?>