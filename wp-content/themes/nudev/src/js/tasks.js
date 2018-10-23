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











    $('.task-options > li > ul').slideUp(0);
    
    $('.task-options > li > a').on('click', do_toggle_accordions );

    // on click anchor element (sibling of nested ul)
    function do_toggle_accordions(e){

        
        // set selector for 'this' sub option list
        var thisSubList = $(this).siblings('ul');
        // set selector for designating open lists
        var isOpen = "js__accordion_isopen";

        var allLists = $('.task-options > li > ul');
        var otherLists = $(allLists).not($(this).siblings('ul'));

        $(otherLists).removeClass(isOpen);
        $(otherLists).slideUp();
        
        // either open or close this sub option list
        if( !$(thisSubList).hasClass(isOpen) ){
            $(thisSubList).addClass(isOpen);
            $(thisSubList).slideDown();
        } else {
            $(thisSubList).removeClass(isOpen);
            $(thisSubList).slideUp();
        }
        
    }
        
});
})(jQuery, this);