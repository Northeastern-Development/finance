!function(_,l,s){_(function(){function l(l){var s="js__collapsible_opened",i=_(this).siblings("div"),e=_(".js__collapsible_list > li > div"),o=_(e).not(i);_(o).removeClass(s),_(o).slideUp(),_(i).hasClass(s)?(_(i).removeClass(s),_(i).slideUp()):(_(i).addClass(s),_(i).slideDown())}_(".js__collapsible_list > li > div").slideUp(0),_(".js__collapsible_list > li > h5").on("click",l),_(".js__collapsible_list > li > h4").on("click",l)})}(jQuery,this);