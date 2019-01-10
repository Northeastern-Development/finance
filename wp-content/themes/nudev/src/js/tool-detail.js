// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {




        Finance.Tools = {

            wrappers : $('div.tool-group'),
            triggers : $('div.tool-group > h4'),
            areas : $('div.tool-group > ul'),
            _init : function(){

                Finance.Tools.areas.slideUp(0);

                Finance.Tools.triggers.on('click', Finance.Tools._collapsibleHandler);

            },
            _collapsibleHandler : function(e){

                // wipe expanded class from all OTHER wrappers
                $(this).parent().siblings().removeClass('js__tool_expanded');

                // check if this trigger is expanded
                if( !$(this).parent().hasClass('js__tool_expanded') ){
                    // add expanded class to this wrapper
                    $(this).parent().addClass('js__tool_expanded');
                } else {
                    $(this).parent().removeClass('js__tool_expanded');
                }

                Finance.Tools.wrappers.each(function(index,el){
                    if( $(el).hasClass('js__tool_expanded') ){
                        $(el).find('ul').slideDown();
                    } else {
                        $(el).find('ul').slideUp();
                        
                    }
                });
                

            }
            
            
        };
        Finance.Tools._init();




    });
})(jQuery, this);