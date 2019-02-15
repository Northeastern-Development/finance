<?php
/**
 *  FAQ section
 *  May appear on ANY page or post
 */

    if( empty($fields) ){
        $fields = get_fields($post->ID);
    }

    $content = '<h2>FAQ</h2><ul class="js__collapsible_list list nufin-faqs">';

    $format = '<li><h5 title="View the answer to the %s FAQ" aria-label="View the answer to the %s FAQ"><span>%s</span></h5><div>%s</div></li>';

    foreach( $fields['faqs'] as $i => $faq ){

        $content .= sprintf(
            $format
            ,$faq['question']
            ,$faq['question']
            ,$faq['question']
            ,$faq['answer']
        );
    }

    $content .= '</ul>';

    echo $content;

 ?>
