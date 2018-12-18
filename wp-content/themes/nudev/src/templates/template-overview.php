<?php 
/**
 * Template Name: Overview
 * Description: The CFO Overview Page
 */
    $fields = get_fields($post_id);
    get_header();
?>
<main>


    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>

    <section>
        <h2>Our Mission</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia ex tenetur reiciendis magnam cupiditate, error fugit odio sit fuga totam aperiam numquam deleniti natus quod aliquam libero corrupti pariatur ut?</p>
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



    <section class="heretohelp">
        <?php 
            // Here2Help,
            if( !empty($fields['helpers']) ){
                include(locate_template('loops/reusable/loop-heretohelp.php'));
            }
         ?>
    </section>
    <section>
    <?php 
        // HelpfulLinks,
        if( $fields['use_pre-footer'] == '1' ){
            include(locate_template('includes/prefooter.php'));
        }
     ?>
    </section>
</main>
<?php 
    get_footer();
 ?>