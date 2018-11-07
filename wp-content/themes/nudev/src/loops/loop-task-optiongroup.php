<?php
// $options = '<ul class="task-options">';
// $guideOptions = '<li><a href="#" class="js__accordion-clickarea"><img src="%s"><h5>%s</h5>%s</a>';
// $guideSubOptions = '<li><h5>%s</h5>%s</li>';


// foreach ($fields['options_group'] as $option) {
//     $options .= sprintf(
//         $guideOptions
//         , $option['icon']
//         , $option['title']
//         , $option['description']
//     );
//     $options .= '<ul class="task-options-option-suboptions">';
//     foreach ($option['sub_options'] as $subOption) {
//       $options .= sprintf(
//           $guideSubOptions
//           , $subOption['title']
//           , $subOption['description']
//       );
//     }
//     $options .= '</ul>';
// }
// $options .= '</ul>';
// $format = '<h2>%s</h2>%s';

// echo sprintf($format, $fields['sub_title'], $options);



$content_option = '<div class="task-options"><h2>' . $fields['sub_title'] . '</h2><ul class="task-options-list js__collapsible_list">';
// 
$format_option = '<li><div class="js__collapsible_toggle"><img src="%s"><h5>%s</h5>%s</div>%s</li>';

// SubOption has a Title and Description ( description is wpautop filtered (wysiwyg) )
$format_suboption = '<li><h5>%s</h5>%s</li>';

foreach ($fields['options_group'] as $option) {
  
  $content_suboption = '';
  foreach ($option['sub_options'] as $suboption) {
    $content_suboption .= sprintf(
        $format_suboption
        ,$suboption['title']
        ,$suboption['description']
    );
  }

  $content_option .= sprintf(
    $format_option
    ,$option['icon']
    ,$option['title']
    ,$option['description']
    ,'<ul class="task-options-list-item-suboptions js__collapsible_area">' . $content_suboption . '</ul>'

  );
  
  
}
$content_option .= '</ul></div>';

echo $content_option;



?>