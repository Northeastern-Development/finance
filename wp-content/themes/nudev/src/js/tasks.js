(function ($, root, undefined) {
$(function () {
        


    // Collapse all Collapsible Fields by Default
    $('.js__collapsible_list .js__collapsible_area').slideUp(0);


    // When clicking a Collapsible Field's "Toggle Area", trigger collapsing for all other collapsibles within its functional grouping ( section, list, etc)
    // Then trigger opening the clicked collapsible
    $('.js__collapsible_list .js__collapsible_toggle').on('click', do_toggle_collapsibles);
    
    function do_toggle_collapsibles(){

        // get the grouping of collapsibles that toggle eachother
        var grouping = $(this).closest('.js__collapsible_list');
        // get the collapsible we are toggling directly
        var thiscollapsible = $(this).siblings('.js__collapsible_area');

        // if this already has the open class (and is open)
        // we need to remove that class and close it
        if( thiscollapsible.hasClass('js__collapsible_open') ){
            grouping.find('.js__collapsible_area').removeClass('js__collapsible_open');
        } else {
            // if not, we need to add that class and open it
            grouping.find('.js__collapsible_area').removeClass('js__collapsible_open');
            thiscollapsible.addClass('js__collapsible_open');
        }

        grouping.find('.js__collapsible_area').not('.js__collapsible_open').slideUp();
        grouping.find('.js__collapsible_open').slideDown();
        
    }
    
    


    // $('.task-options > li > ul').slideUp(0);
    
    // $('.task-options > li > a').on('click', do_toggle_accordions );

    // // on click anchor element (sibling of nested ul)
    // function do_toggle_accordions(e){

        
    //     // set selector for 'this' sub option list
    //     var thisSubList = $(this).siblings('ul');
    //     // set selector for designating open lists
    //     var isOpen = "js__accordion_isopen";

    //     var allLists = $('.task-options > li > ul');
    //     var otherLists = $(allLists).not($(this).siblings('ul'));

    //     $(otherLists).removeClass(isOpen);
    //     $(otherLists).slideUp();
        
    //     // either open or close this sub option list
    //     if( !$(thisSubList).hasClass(isOpen) ){
    //         $(thisSubList).addClass(isOpen);
    //         $(thisSubList).slideDown();
    //     } else {
    //         $(thisSubList).removeClass(isOpen);
    //         $(thisSubList).slideUp();
    //     }
        
    // }
        
});
})(jQuery, this);