<?php
/**
 * Template Name: Financial Statements
 */

    $fields = get_fields($post->ID);
    // Files Section (required)
    $content = '<ul>';

    $guide = '
        <li>
            <a target="_blank" title="Click to Download (opens in a new window)" href="%s"><i class="material-icons">arrow_forwards</i>%s</a>
        </li>
    ';

    foreach( $fields['files'] as $file ){
        $content .= sprintf(
            $guide
            ,$file['file']
            ,$file['name']
        );
    }
    $content .= '</ul>';
get_header();
?>
<main id="financialstatements" role="main">

    <?php 
        $fields = get_fields($post_id);
        include(locate_template('includes/pagehero.php'));
        echo PageHero::return_pagehero($fields);
     ?>

    <section>
        <?= $content; ?>
    </section>

    <section>
        <?php 
            // FAQ,
            if( !empty($fields['faqs']) ){
                include(locate_template('loops/reusable/loop-faqs.php'));
            }
         ?>
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
