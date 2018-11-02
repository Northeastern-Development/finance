(function ($, root, undefined) {
$(function () {
        



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