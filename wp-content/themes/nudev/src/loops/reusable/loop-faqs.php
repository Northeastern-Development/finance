<?php 
/**
 *  FAQ section
 *  May appear on ANY page or post
 */

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }

    
    $content = '<div><h2>FAQ</h2><ul class="js__collapsible_list">';
    
    $format = '<li><h5>%s</h5><p>%s</p></li>';

    foreach( $fields['faqs'] as $i => $faq ){
        
        $content .= sprintf(
            $format
            ,$faq['question']
            ,$faq['answer']
        );
    }
    
    $content .= '</ul></div>';

    echo $content;

 ?>