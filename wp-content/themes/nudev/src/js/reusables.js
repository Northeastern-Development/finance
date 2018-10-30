(function ($, root, undefined) {
    $(function () {
            
       
    
    
        $('.js__collapsible_list > li > p').slideUp(0);
    
        $('.js__collapsible_list > li > h5').on('click', do_toggle_faqs);
    
        function do_toggle_faqs(e){
    
            var open = "js__collapsible_opened";
            var thisCollapsible = $(this).siblings('p');
            var allCollapsibles = $('.js__collapsible_list > li > p');
            var otherCollapsibles = $(allCollapsibles).not(thisCollapsible);
    
            $(otherCollapsibles).removeClass(open);
            $(otherCollapsibles).slideUp();
    
            if( !$(thisCollapsible).hasClass(open) ){
                $(thisCollapsible).addClass(open);
                $(thisCollapsible).slideDown();
            } else {
                $(thisCollapsible).removeClass(open);
                $(thisCollapsible).slideUp();
            }
            
        }
    
            
    });
})(jQuery, this);