(function ($, root, undefined) {
$(function () {
    

    $('.js__collapsible .js__collapsible_hiddenarea').slideUp(0);
    
    // just for now
    $('.js__collapsible_clickarea').on('click', do_toggle_collapsible_fields);

    function do_toggle_collapsible_fields(){

        if( $(this).next('.js__collapsible_hiddenarea').hasClass('js__collapsible_open') ){
            $(this).next('.js__collapsible_hiddenarea').removeClass('js__collapsible_open');
        } else {
            $(this).next('.js__collapsible_hiddenarea').addClass('js__collapsible_open');
        }

        $('.js__collapsible .js__collapsible_hiddenarea').slideUp();
 


        $(this).next('.js__collapsible_hiddenarea.js__collapsible_open').slideDown();

    }
    
    
    
    
    
    
    
            
});
})(jQuery, this);