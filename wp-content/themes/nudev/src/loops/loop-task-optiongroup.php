<?php 
$options = '<ul class="task-options">';
$guideOptions = '<li><a href="#" class="js__accordion-clickarea"><img src="%s"><h5>%s</h5>%s</a>';
$guideSubOptions = '<li><h5>%s</h5>%s</li>';
foreach ($taskFields['options_group'] as $option) {
    $options .= sprintf(
        $guideOptions
        , $option['icon']
        , $option['title']
        , $option['description']
    );
    $options .= '<ul class="task-options-option-suboptions">';
    foreach ($option['sub_options'] as $subOption) {
      $options .= sprintf(
          $guideSubOptions
          , $subOption['title']
          , $subOption['description']
      );
    }
    $options .= '</ul>';
}
$options .= '</ul>';
$format = '<section><h2>%s</h2>%s</section>';
echo sprintf($format, $taskFields['sub_title'], $options);
?>
