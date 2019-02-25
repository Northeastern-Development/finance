// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {



        Finance.Tasks = {

            solutions : $('.js__tasks_solutions'),
            steps : $('.js__tasks_steps'),
            
            _init : function(){

                Finance.Tasks.steps.slideUp(0);
                Finance.Tasks.solutions.find('>li>a').on('click', Finance.Tasks._clickHandler);
            },
            _clickHandler : function(e){

                var isOpen = 'js__tasks_viewable_steps';
                $(this).parent('li').siblings().removeClass(isOpen);
                if( !$(this).parent('li').hasClass(isOpen) ){
                    $(this).parent('li').addClass(isOpen);
                } else {
                    $(this).parent('li').removeClass(isOpen);
                }
                Finance.Tasks.steps.parent().each(function(index, el){
                    if ($(el).hasClass(isOpen)) {
                        $(el).find('.js__tasks_steps').slideDown(200);
                    } else {
                        $(el).find('.js__tasks_steps').slideUp(200);
                    }
                });
            }
        }
        Finance.Tasks._init();
    });
})(jQuery, this);