var exceedsContainer = false;
var Finance = {};
(function ($, root, undefined) {
    $(function () {



        Finance.NavHandler = {

            isHomepage: ($('main > div#howdoi').length > 0) ? true : false,
            navItems: $('#nu__main-nav-desktop > ul > li > a'),
            dropdownPanels : $('li.has-children > .neumenu-wrapper'),

            _init : function(){

                Finance.NavHandler.navItems.on('focus blur click', Finance.NavHandler._navInteractionHandler);

                // if focus leaves the about dropdown menu, close it
                $('#nu__main-nav-desktop > ul > li:last-child > .neumenu-wrapper > div > a:last-child').on('blur', function(e){
                    if( $(this).parent().find($(e.relatedTarget)).length == 0 ){
                        // close all dropdowns
                        Finance.NavHandler.dropdownPanels.hide();
                    }
                });
                
            },
            _navInteractionHandler : function(e){

                

                e.stopPropagation();
                
                if(e.type=="click"){
                    if($(this).data("justfocussed")){
                        $(this).data("justfocussed",false);
                    }
                    // is clicked while already focussed
                    else {

                        // close all dropdowns
                        Finance.NavHandler.dropdownPanels.hide();
                        // blur this nav item ( to enable clicking it again to focus and reveal its panel)
                        $(this).blur();
                        
                    }
                }
                // is focussed only
                else if(e.type=="focus"){
                    $(this).data("justfocussed",true);
                    
                    
                    
                    
                    // close all dropdowns
                    Finance.NavHandler.dropdownPanels.hide();
                    // open dropdown if available
                    $(this).parent('li.has-children').find('.neumenu-wrapper').show();
                    
                    
                }
                // is blurred
                else {
                    $(this).data("justfocussed",false);

                    
                    // close "other" dropdowns
                    $('#nu__main-nav-desktop > ul > li.has-children').not($(this).parent()).find('.neumenu-wrapper').hide();

                    //  we are on the home page
                    if( Finance.NavHandler.isHomepage ){

                        // if focus has NOT shifted to a sub-nav item, and the focus has not shifted to the howdoi in the body
                        if( !$(this).parent().find(e.relatedTarget.length == 0) && !$('main > #howdoi').find(e.relatedTarget.length == 0) ){
                            // we need to close all nav dropdowns
                            Finance.NavHandler.dropdownPanels.hide();
                        }

                    }
                    // we are not on the home page
                    else {
                        // if focus has NOT shifted to a sub-nav item
                        if( $(this).parent().find(e.relatedTarget).length == 0 ){
                            // we need to close all nav dropdowns
                            Finance.NavHandler.dropdownPanels.hide();
                        }
                    }
                    
                }
            }
            
        }
        Finance.NavHandler._init();
        
        
        
        /**
         * 
         */
        Finance.Focuser = {

            isHomepage: ($('main > div#howdoi').length) ? true : false,
            dropdowns: $('#nu__main-nav-desktop > ul > li.has-children'),
            navItems: $('#nu__main-nav-desktop > ul > li > a'),
            dropdownItems: $('#nu__main-nav-desktop > ul > li.has-children .neumenu-wrapper-inner > a'),
            howdoiHomepageLinks: $('main > div#howdoi > .neumenu-wrapper-inner > div:last-child > div > a'),
            navItemsWithDropdowns: $('#nu__main-nav-desktop > ul > li.has-children').has('.neumenu-wrapper').find('>a'),


            _init: function () {

                Finance.Focuser.navItems.on('focus', function(){

                    Finance.Focuser.dropdowns.not( $(this).parent() ).find('.neumenu-wrapper').hide();
                    
                });

                // on focus a nav item w/ a dropdown; reveal the dropdown
                Finance.Focuser.navItemsWithDropdowns.on('focus click blur', function (e) {
                    // 
                    e.stopPropagation();
                    // 
                    if(e.type=="click"){
                        // 
                        if( $(this).data("justfocussed") ){
                            $(this).data("justfocussed",false);
                        }
                        // 
                        else {
                            //I have been clicked on whilst in focus
                            console.log("click");
                            // if( !$(this).parent().find('.neumenu-wrapper').is(':hidden') ){
                            //     $(this).parent().find('.neumenu-wrapper').hide();
                            //     $(this).blur();
                            // }
                        }
                    }
                    // 
                    else if(e.type=="focus"){
                        //I have been focussed on (either by clicking on whilst blurred or by tabbing to)
                        console.log("focus");
                        $(this).data("justfocussed",true);

                        $(this).parent().find('.neumenu-wrapper').show();
                    }
                    // 
                    else {
                        //I no longer have focus
                        console.log("blur");
                        $(this).data("justfocussed",false);
                    }
                    
                });

                



                // on blur a nav item w/ a dropdown; (maybe) hide the dropdown
                Finance.Focuser.navItemsWithDropdowns.on('blur', function (e) {
                    // if focus is not on a sub-item (if focus is on a sub-item the menu will remain open)
                    if ($(this).parent().find($(e.relatedTarget)).length == 0) {
                        // hide this dropdown
                        // $(this).parent().find('.neumenu-wrapper').hide();
                    }
                });

                // The Home Page ONLY
                if (Finance.Focuser.isHomepage) {


                    // Handle "HowDoI" Focus (top-level nav)
                    $('li.has-children[data-id="howdoi"] > a').on('focus', function (e) {
                        
                        // the howdoi menu is displaying categories
                        if( $('main > #howdoi > div:last-of') ){

                        }
                        // howdoi menu is displaying tasks
                        else {

                        }

                        // be sure all the howdoi menu items in <main> have default tabindex settings
                        $('main > div#howdoi > .neumenu-wrapper-inner > div:last-child > div > a').attr('tabindex', '0');
                        // set that focus to the howdoi menu in the <main>
                        $('main > div#howdoi > .neumenu-wrapper-inner > div:last-child > div:first-child > a').focus();
                        // hide any open dropdowns
                        Finance.Focuser.dropdowns.find('.neumenu-wrapper').hide();
                        // remove the 'showme' class tagging the dropdown parent from all items
                        Finance.Focuser.navItems.parent().removeClass('neu__showme');

                        
                    });



                    // Handle "About" Focus
                    $('li.has-children[data-id="about"] > a').on('focus', function (e) {
                        // if focus comes from the <main> howdoi...
                        if ($('main > #howdoi').find(e.relatedTarget).length > 0) {
                            // send focus to the logo
                            $('div#header .logo > a').focus();
                        }
                    });
                    // when the hero button ( first <a> in the body) is focused
                    $('section.hero a.nu__content_btn').on('focus', function (e) {
                        // remove the 'showme' class tagging the dropdown parent from all items
                        Finance.Focuser.navItems.parent().removeClass('neu__showme');
                        // hide all the dropdowns
                        Finance.Focuser.dropdowns.find('.neumenu-wrapper').hide();
                        // if the howdoi in the <main> has tabindex, remove it from tabindex, and focus the forms top level nav link
                        if ($('main > div#howdoi > .neumenu-wrapper-inner > div:last-child > div > a').attr('tabindex') === '0') {
                            // reset the howdoi menu items to tabindex -1 
                            $('main > div#howdoi > .neumenu-wrapper-inner > div:last-child > div > a').attr('tabindex', '-1');
                            // send focus to the forms top level nav item
                            $('#nu__main-nav-desktop > ul > li:nth-child(2) > a').focus();
                        }
                    });
                }
                // NOT the Home Page
                else {

                    // on blur the last dropdown item check that we are passing focus outside the dropdown
                    $('#nu__main-nav-desktop > ul > li:last-child > .neumenu-wrapper > div > a:last-child').on('blur', function (e) {
                        // if we are passing focus from the about dropdown last child (contact us) OUTSIDE the dropdown (to the body), then we need to close the nav
                        if ($(this).parent().find($(e.relatedTarget)).length == 0) {
                            Finance.Focuser.dropdowns.find('.neumenu-wrapper').hide();
                        }
                    });

                    
                    $('.logo > a').on('focus', function (e) {
                        $('li.has-children[data-id="howdoi"]').find('.neumenu-wrapper').hide();
                    });


                    $('li.has-children[data-id="howdoi"] > a').on('focus', function(e){

                        // what do?
                        e.stopPropagation();
                        // 
                        if(e.type=="click"){
                            // 
                            if( $(this).data("justfocussed") ){
                                $(this).data("justfocussed",false);
                            }
                            // 
                            else {
                                //I have been clicked on whilst in focus
                                console.log("click");
                            }
                        }
                        // 
                        else if(e.type=="focus"){
                            //I have been focussed on (either by clicking on whilst blurred or by tabbing to)
                            console.log("focus");
                            
                            $(this).data("justfocussed",true);

                            
                            if( $(this).parent().find(e.relatedTarget).length > 0 ){
                                $('.logo > a').focus();
                            } else {
                                // send the focus to the subnav....
                                $(this).parent().find('.neumenu-wrapper-inner > div:last-child > div > a').attr('tabindex', '0');
                                $(this).parent().find('.neumenu-wrapper-inner > div:last-child > div:first-child > a').focus();
                            }

                        }
                        // 
                        else {
                            //I no longer have focus
                            console.log("blur");
                            $(this).data("justfocussed",false);

                        }
                        
                    });


                    // normal HowdoI functionality below ( as a dropdown of the main nav, not as a independent section i.e. the homepage )
                    // $('li.has-children[data-id="howdoi"] > a').on('focus', function (e) {

                    //     // if focus has been sent by the sub-menu
                    //     if ($(this).parent().find(e.relatedTarget).length > 0) {

                    //         $('.logo > a').focus();

                    //     }
                    //     // focus is coming from anywhere except the submenu
                    //     else {
                    //         // be sure all the howdoi menu items in <main> have default tabindex settings
                    //         $('div#howdoi > .neumenu-wrapper-inner > div:last-child > div > a').attr('tabindex', '0');

                    //         // set that focus to the howdoi menu in the <main>
                    //         $('div#howdoi > .neumenu-wrapper-inner > div:last-child > div:first-child > a').focus();
                    //     }
                    // });
                }
            }
        }
        // Finance.Focuser._init();


        Finance.Nav = {

            parentlinks: $('nav.nu__main-nav > ul > li.has-children > a'),
            dropdowns: $('nav.nu__main-nav > ul > li.has-children'),
            categories: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:last-child > div'),
            backtocats: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:first-child > .removefilter'),

            _init: function () {
                $('div.wrapper, footer, div#nu__global-footer').on('click', Finance.Nav._didClickOutsideNav);
                Finance.Nav.parentlinks.on('click', Finance.Nav._didClickDropdown);
                Finance.Nav.categories.on('click', Finance.Nav._didClickCategory);
                Finance.Nav.backtocats.on('click', Finance.Nav._didClickBackToCats);
            },
            _didClickBackToCats: function () {
                Finance.Nav.categories.removeClass('theFilter');
                Finance.Nav.categories.parents('.neumenu-wrapper-inner').removeClass('isFiltered');
            },
            _didClickCategory: function (e) {
                $(this).parents('.neumenu-wrapper-inner').addClass('isFiltered');
                $(this).addClass('theFilter');
            },
            _didClickOutsideNav: function (e) {
                if ($('div#nu__globalheader, div#header').has(e.target).length === 0) {
                    // clicked outside nav; if nav open then close dropdowns
                    // $('li.has-children.neu__active').removeClass('neu__active');
                    $('li.has-children').find('.neumenu-wrapper').hide();
                    $('li.has-children').find('.isFiltered').removeClass('isFiltered');
                    $('li.has-children').find('.theFilter').removeClass('theFilter');

                    Finance.Nav.dropdowns.removeClass('neu__showme');

                    // good place to help out the mobile nav too
                    $('#neu__navicon').removeAttr('checked');
                    $('#nu__mobile a.active').removeClass('active');
                    $('#nu__mobile .show').hide();
                    $('#nu__mobile .show').removeClass('show');
                    $('html, body').removeClass('neu__noscroll');

                }
            },
            _didClickDropdown: function (e) {

                // if the dropdown is already open, close it
                // 



                // e.stopPropagation();
                // e.preventDefault();
                // if the other dropdown is visible,
                // if (!$(this).parent().siblings('.has-children').find('.neumenu-wrapper').is(':hidden')) {
                //     // hide the other dropdown
                //     $(this).parent().siblings('.has-children').find('.neumenu-wrapper').hide();
                // }

                // // if the other dropdown has a showme class
                // if ($(this).parent().siblings('.has-children').hasClass('neu__showme')) {
                //     $(this).parent().siblings('.has-children').removeClass('neu__showme');
                // }

                // // if this dropdown is hidden,
                // if ($(this).parent().find('.neumenu-wrapper').is(':hidden')) {
                //     // show this dropdown
                //     $(this).parent().find('.neumenu-wrapper').show();
                //     // when this dropdown is shown; apply a showme class
                //     $(this).parent().addClass('neu__showme');
                // }
                // // if this dropdown is visible,
                // else {
                //     // hide this dropdown
                //     $(this).parent().find('.neumenu-wrapper').hide();
                //     // when this dropdown is hidden, remove the showme class
                //     $(this).parent().removeClass('neu__showme');
                // }

            }
        }
        Finance.Nav._init();












        Finance.MobileNav = {

            navicon: $('#neu__navicon-label'),
            nav: $('#nu__mobile'),

            _init: function () {

                Finance.MobileNav.navicon.on('click', Finance.MobileNav._didClickNavicon);

            },
            _didClickNavicon: function (e) {
                $('body').toggleClass('neu__noscroll');
            }


        }
        Finance.MobileNav._init();


        //MOBILE ACCORDION NAV
        $('.js-mobile-nav').click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.next().hasClass('show')) {
                $this.next().removeClass('show');
                $this.removeClass("active");
                $this.next().slideUp(350);
            } else {
                $this.parent().parent().find('li .inner').removeClass('show');
                if ($this.hasClass('parent')) {
                    /* JUST REMOVING HERE CLASS .ACTIVE FROM EARLY APPLIED */
                    $this.parents("#nu__mobile > nav ul").find(".toggle").removeClass("active");
                } else if ($this.hasClass('child')) {
                    /* JUST REMOVING HERE CLASS .ACTIVE FROM EARLY APPLIED FOR CHILD */
                    $this.parents("#nu__mobile > nav ul").find(".toggle.child").removeClass("active");
                } else {
                    /* JUST REMOVING HERE CLASS .ACTIVE FROM EARLY APPLIED FOR CHILD OF CHILD */
                    $this.parents("#nu__mobile > nav ul").find(".toggle.child-child").removeClass("active");
                }
                $this.parent().parent().find('li .inner').slideUp(350);
                $this.next().toggleClass('show');
                $this.addClass("active");
                $this.next().slideToggle(350);
            }
        });




        Finance.JumpNav = {

            _init: function () {
                // on load wont work because collapsibles are open on load, and closed by a jquery function immediately after
                // instead, on load is handled by the collapsibles loadhandler (Finance.faqs._loadHandler)
                // $(window).on('load', Finance.JumpNav._doHashHandler);]
                // the on hash change event handler works when a hash is entered into the already loaded page
                $(window).on('hashchange', Finance.JumpNav._doHashHandler);
            },
            _doHashHandler: function (e) {

                var hash = window.location.hash.substring(1);
                if (!hash) {
                    return;
                }
                var headheight = $('div#nu__globalheader').height() + $('header').height();
                var baseoffset = $('#' + hash).offset().top;
                $(window).scrollTop(baseoffset - headheight);
            },
        }
        Finance.JumpNav._init();



        Finance.faqs = {
            triggers: $('.js__collapsible_list > li > h5'),
            questions: $('.js__collapsible_list > li'),
            answers: $('.js__collapsible_list > li > div'),
            _init: function () {
                $(window).on('load', Finance.faqs._loadHandler);
                Finance.faqs.triggers.on('click', Finance.faqs._clickHandler);
            },
            _loadHandler: function (e) {
                Finance.faqs.answers.slideUp(0);
                Finance.JumpNav._doHashHandler();
            },
            _clickHandler: function (e) {

                // the "trigger h5" has an :after for the chevron,
                // we need to flip that upside down


                //  (possible to easily tighten this up)
                var open = "js__collapsible_opened";
                var thisAnswer = $(this).siblings('div');
                var otherAnswers = Finance.faqs.answers.not(thisAnswer);

                $(otherAnswers).removeClass(open);
                $(otherAnswers).slideUp(200);


                Finance.faqs.questions.removeClass('js__collapsible_triggered');

                // expand
                if (!$(thisAnswer).hasClass(open)) {

                    $(this).parent('li').addClass('js__collapsible_triggered');

                    $(thisAnswer).addClass(open);
                    $(thisAnswer).slideDown(200);
                }
                // collapse
                else {
                    $(this).parent('li').removeClass('js__collapsible_triggered');

                    $(thisAnswer).removeClass(open);
                    $(thisAnswer).slideUp(200);
                }
            }
        }
        Finance.faqs._init();



    });
})(jQuery, this);