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
            <h4><div class="kri__more-link">%s</div></h4>
            <h4><div class="kri__more-link">%s</div></h4>
        </div>
        <div style="background: url(%s)"></div>
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
    , ( !empty($fields['email']) ) ? '<a href="'.$fields['email'].'" title="Send an email" class="email">' . $fields['email'] . '</a>' : null
    , ( !empty($fields['phone']) ) ? '<a href="tel:'.$fields['phone'].'" title="Call" class="phone">' . $fields['phone'] . '</a>' : null
    , $fields['headshot']['url']
    , $fields['description']
);
?>


<div id="staffbio"><?php echo $content_overlay; ?></div>

<?php unset($args,$res,$fields);	// cleanup ?>
