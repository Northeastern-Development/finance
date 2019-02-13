<?php 
class PageHero
{
    /**
     * return formatted string for a page hero
     *
     * @param array $fields
     * @param string $title (optional)
     * @param string $description (optional)
     * @return string formatted (sprintf) string of section.hero w/ bg img, title and description
     */
    public static function return_pagehero($fields = null, $title = null, $description = null){

        // fields were passed, and use_pagehero is active
        if( $fields != null && $fields['use_hero'] == '1' ){

            $imgs = get_fields(3472)['hero_images'];
            if(!empty($imgs)){
                if( count($imgs) == 1 ){
                    $img = wp_get_attachment_image_src($imgs[0]['image'], 'full');
                }
                // if there are multiple images
                if( count($imgs) > 1 ){
                    $img = wp_get_attachment_image_src($imgs[ mt_rand(0, count($imgs) - 1) ]['image'], 'full');
                }
            }
        
            global $post;
            
            // only fields were passed; try to use those
            if( $title == null && $description == null){
                // try/set title
                $hero_title = $fields['hero_title'];
                // try/set description
                $hero_description = $fields['hero_description'];
            }

            // if title is manually specified,
            if( $title != null ){
                // set hero title to manual specification
                $hero_title = $title;
            }
            // if description is manually specified
            if( $description != null ){
                // set hero description to manual specification
                $hero_description = $description;
            }

            // if title cannot be determined ( was not manually passed, and field was empty )
            if( empty($hero_title) && !empty($post->post_title)){
                // try to use the post title for this page
                $hero_title = $post->post_title;
            }

            // if description cannot be determined ( was not manually passed, and field was empty )
            if( empty($hero_description) ){
                // just dont use a description
            }

            // sprintf format string 
            $format_hero = '
                <section class="hero hero-image" style="background-image: url(%s)">
                    <div>
                        %s
                        %s
                    </div>
                </section>
            ';
            // sprintf return string
            $content_hero = sprintf(
                $format_hero
                ,$img[0]
                ,( !empty($hero_title) ) ? '<h1>'.$hero_title.'</h1>' : null
                ,( !empty($hero_description) ) ? '<h3>'.$hero_description.'</h3>' : null
            );

            // return (not echo) to allow more flexible usage
            return $content_hero;
        }
    }
}
new PageHero();
?>