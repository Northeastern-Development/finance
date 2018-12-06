<?php
    // Get : gallery of images to be randomized from the config page (  )
    $images = get_fields(3472)['hero_images'];
    $hero_image = wp_get_attachment_image_src($images[mt_rand(0, count($images) - 1)]['image'], 'full');
    $format_hero = '
        <section class="hero hero-image" style="background-image: url('.$hero_image[0].')">
            <div>
                %s
                %s
            </div>
        </section>
    ';
    $content_hero = sprintf(
        $format_hero
        ,( !empty($fields['title'])  ) ? '<h1>'.$fields['title'].'</h1>' : null
        ,( !empty($fields['description'])  ) ? '<h3>'.$fields['description'].'</h3>' : null
    );
    echo $content_hero;
?>
