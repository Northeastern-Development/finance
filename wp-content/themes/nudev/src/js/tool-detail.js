// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {

        Finance.Tools = {

            wrapper : $('div.tool-group'),
            collapse_initially : $('div.tool-group > ul'),
            _init : function(){
                // code here
                Finance.Tools.collapse_initially.slideUp(0);
                Finance.Tools.wrapper.on('click', Finance.Tools._toggleCollapse);
            },
            _toggleCollapse : function(e){
                $(this).find('> ul').slideDown();
            }
        };

        Finance.Tools._init();

    });
})(jQuery, this);