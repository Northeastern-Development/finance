// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {

        Finance.tasks = {

            solutionsWrapper : $('.js__tasks_solutions'),
            solutions : $('.js__tasks_solutions > li'),
            stepsWrapper : $('.js__tasks_steps'),
            steps : $('.js__tasks_steps > li'),

            
            _init : function(){


                Finance.tasks.stepsWrapper.slideUp(0);
                
                Finance.tasks.solutions.on('click', Finance.tasks._clickHandler);
                
            },
            _clickHandler : function(e){

                var open = 'js__tasks_steps_open';
                var theseSteps = $(this).find('.js__tasks_steps');

                Finance.tasks.stepsWrapper.slideUp();
                
                if( !theseSteps.hasClass(open) ){
                    theseSteps.addClass(open);
                    theseSteps.slideDown();
                } else {
                    theseSteps.removeClass(open);
                    theseSteps.slideUp();
                }
                               
            }
        }
        Finance.tasks._init();


    });
})(jQuery, this);