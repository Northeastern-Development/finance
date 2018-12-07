<?php 

$imgs = get_fields(3472)['hero_images'];
if( !empty($imgs) ){

    if( count($imgs) == 1 ){
        $img = wp_get_attachment_image_src($imgs[0]['image'], 'full');
    }

    if( count($imgs) > 1 ){
        $img = wp_get_attachment_image_src($imgs[ mt_rand(0, count($imgs) - 1) ]['image'], 'full');
    }

    $format_hero = '
        <section class="hero hero-image" style="background-image: url(%s)">
            <div>
                %s
                %s
            </div>
        </section>
    ';

    if( empty($base_title) ){
        $base_title = $post->post_title;
    }
    $title = ( !empty($fields['hero_title']) ) ? '<h1>'.$fields['hero_title'].'</h1>' : '<h1>'.$base_title.'</h1>';
    $description = ( !empty($fields['hero_description']) ) ? '<h3>'.$fields['hero_description'].'</h3>' : null ;

    $content_hero = sprintf(
        $format_hero
        ,$img[0]
        ,$title
        ,$description
    );
    echo $content_hero;
}
?>