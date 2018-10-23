<?php 
/**
 * FAQ Section
 */
$format = '<li><h5>%s</h5><p>%s</p></li>';

$content = '<h2>FAQ</h2><ul class="js__collapsible_list">';

foreach ($taskFields['faq'] as $faq) {

    $content .= sprintf(

        $format
        , $faq['question']
        , $faq['answer']
        
    );
}
$content .= '</ul>';
echo $content;
?>