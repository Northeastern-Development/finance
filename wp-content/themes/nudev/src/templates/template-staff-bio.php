<?php
/**
 * Template Name: Bio 
 */

 $args = array(
    'name'        => $wp_query->query_vars['show-bio'],
    'post_type'   => 'staff',
    'numberposts' => 1
);
$res = get_posts($args)[0];
$fields = get_fields($res->ID);

$format_overlay = '
    <div class="contact">
        <div>
            <h2>%s</h2>
            <h3>%s</h3>
            <p>%s</p>
            <p>%s</p>
        </div>
        <div class="neu__bgimg"><div style="background-image: url(%s)"></div></div>
    </div>
    <div class="about">
        <h3>About</h3>
        %s
    </div>
';
$content_overlay = sprintf(
    $format_overlay
    ,$res->post_title
    , ( !empty($fields['title']) ) ? $fields['title'] : null
    , ( !empty($fields['email']) ) ? '<a class="neu__iconlink" href="'.$fields['email'].'" aria-label="Email '.$res->post_title.'" title="Email '.$res->post_title.'" class="email">' . $fields['email'] . '</a>' : null
    , ( !empty($fields['phone']) ) ? '<a class="neu__iconlink" href="tel:'.$fields['phone'].'" aria-label="Call '.$res->post_title.'" title="Call '.$res->post_title.'" class="phone">' . $fields['phone'] . '</a>' : null
    , $fields['headshot']['url']
    , $fields['description']
);
?>


<div id="staffbio"><?php echo $content_overlay; ?></div>

<?php unset($args,$res,$fields);	// cleanup ?>
