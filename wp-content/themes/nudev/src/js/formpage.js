(function ($, root, undefined) {
$(function () {
    

    $('.js__forms_collapsible').slideUp(0);

    $('.forms-category > h5').on('click', do_toggle_collapsible);

    function do_toggle_collapsible(){
        $(this).next('.js__forms_collapsible').slideToggle();
    }
            
});
})(jQuery, this);