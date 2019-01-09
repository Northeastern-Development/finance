// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {

        Finance.Tasks = {

            allsolutions : $('.js__tasks_solutions'),
            anysolution : $('.js__tasks_solutions > li'),
            allsteps : $('.js__tasks_steps'),
            anystep : $('.js__tasks_steps > li'),

            _init : function(){
                // collapse initially hidden groups
                Finance.Tasks.allsteps.slideUp(0);

                Finance.Tasks.anysolution.on('click', Finance.Tasks._toggleCollapsible);
            },
            _toggleCollapsible : function(e){

                // set an active class ( expanded/collapsed )
                var isOpen = 'js__tasks_viewable_steps';
                
                // remove the active class from all solutions except the one we are clicking
                $(this).siblings().removeClass(isOpen);
                
                // if the solution being clicked did not have the active class already,
                // , add the active class to this solution ( expand this solution)
                if( !$(this).hasClass(isOpen) ){
                    $(this).addClass(isOpen);
                }
            
                // if the solution being clicked already has the active class
                // , remove that active class (collapse this solution)
                else {
                    $(this).removeClass(isOpen);
                }
            
                // now, each solution should have its collapsed/expanded state designated by the active class,
                // we can now hide all solutions and then show the active state one
            
                Finance.Tasks.anysolution.each(function(index, el){
                    if( $(el).hasClass(isOpen) ){
                        $(el).find('.js__tasks_steps').slideDown();
                    } else {
                        $(el).find('.js__tasks_steps').slideUp();
                    }
                });
                
            }
            
            
        }
        Finance.Tasks._init();
        
        
        
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
        // Finance.tasks._init();


    });
})(jQuery, this);