var exceedsContainer = false;
var Finance = {};
(function ($, root, undefined) {
    $(function () {

        Search = {

            toggleOpen : $('#neu__sitesearch-toggle'),
            form : $('#neu__sitesearch-form'),
            input : $('#neu__sitesearch-form > input[type="text"]'),
            toggleClosed : $('.neu__sitesearch-closebutton'),

            _init : function(){

                Search.toggleOpen.on('click', Search._doOpenSearchBar);
                Search.toggleClosed.on('click', Search._doCloseSearchBar);
                $(document).on('click', function(e){
                    if( !$(e.target).closest('#header').length ){
                        Search._doCloseSearchBar();
                    }
                });

                Search.form.on('blur', 'button', function(e){
                    
                    if( !$(e.relatedTarget).closest(Search.form).length ){
                        Search._doCloseSearchBar();
                    }
                    
                });
            }
            ,_doOpenSearchBar : function(e){
                Search.form.addClass('neu__sitesearch-form--shown');

                Search.form.find('button, input').attr('tabindex', '0');
                Search.input.focus();
            }
            ,_doCloseSearchBar : function(e){
                Search.form.find('button, input').attr('tabindex', '-1');
                Search.form.removeClass('neu__sitesearch-form--shown');
            }
        }
        Search._init();
        
        
        
        
        NewNav = {

            _init : function(){

                // if click is outside the nav close dropdowns etc.
                $(document).on('click', function(e){
                    if( !$(e.target).closest('#nu__main-nav-desktop').length ){
                        $('li.has-children').removeClass('neu__showme');
                    }
                });
                
                // if click is on a dropdown
                // $('#nu__main-nav-desktop li.has-children').on('click', 'a[role="menuitem"]', NewNav._didClickNavItem);
                
                // ARIA
                NewNav._doARIA();
            }
            /**
             * 
             */
            ,_doARIA : function(){

                $('header').on('focus', 'div.logo', function(e){
                    $('li.has-children').removeClass('neu__showme');
                    $('li.has-children > a[role="menuitem"]').attr('aria-expanded', 'false');
                });
                $('header').on('focus', 'a#neu__sitesearch-toggle', function(e){
                    $('li.has-children').removeClass('neu__showme');
                    $('li.has-children > a[role="menuitem"]').attr('aria-expanded', 'false');
                });

                // when we focus on a a nav item
                $('#nu__main-nav-desktop > ul[role="menubar"]').on('focus', '>li > a[role="menuitem"]', function(e){

                    // close 'other' dropdowns
                    $(this).parent().siblings('li.has-children').removeClass('neu__showme');
                    $(this).parent().siblings('li.has-children').attr('aria-expanded', 'false');
                    
                    // if this is a dropdown
                    if( $(this).parent().hasClass('has-children') ){                        

                        if( !$(this).parent().hasClass('neu__showme') ){
                            // open the hidden menu
                            $(this).attr('aria-expanded', 'true');
                            $(this).parent().addClass('neu__showme');
                        } else {
                            // hide the hidden menu
                            $(this).attr('aria-expanded', 'false');
                            $(this).parent().removeClass('neu__showme');
                        }

                    }
                    
                });

                
                // end _doARIA
            }
            /**
             * Clicked a Dropdown
             */
            ,_didClickNavItem : function(e){
                // handle toggling dropdowns
                if( $(this).siblings('ul[role="menu"], div.neumenu-wrapper').length ){
                    if( !$(this).parent().hasClass('neu__showme') ){
                        $(this).attr('aria-expanded', 'true');
                        $(this).parent().addClass('neu__showme');
                    } else {
                        $(this).attr('aria-expanded', 'false');
                        $(this).parent().removeClass('neu__showme');
                    }
                }
                $(this).parent().siblings('li.has-children').removeClass('neu__showme');
            }
        }
        NewNav._init();

        
        /**
         * 
         * 
         */
        Finance.NavHandler = {
            isHomepage: ($('main > div#howdoi').length > 0) ? true : false,
            navItems: $('#nu__main-nav-desktop > ul > li > a'),
            dropdownPanels: $('li.has-children > .neumenu-wrapper'),
            _init: function () {
                
                Finance.NavHandler.navItems.on('focus blur click', Finance.NavHandler._navInteractionHandler);

                // if focus leaves the about dropdown menu, close it
                $('#nu__main-nav-desktop > ul > li:last-child > .neumenu-wrapper > div > a:last-child').on('blur', function (e) {
                    if ($(this).parent().find($(e.relatedTarget)).length == 0) {
                        // close all dropdowns
                        Finance.NavHandler.dropdownPanels.hide();
                        // remove showme
                        Finance.NavHandler.dropdownPanels.parent('li.has-children').removeClass('neu__showme');
                    }
                });
                // if we blur from the back to topics button back to the howdoi top level link,
                // or if we blur from the last task to the forms top level link
                // we have 'left' the howdoi nav and it must be reset to its initial state
                $('#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li:last-of-type > a, #howdoi .neumenu-wrapper-inner>div:first-of-type > a').on('blur', function (e) {
                    // check if we have passed focus to the forms link or the howdoi link (top level)
                    // if we have done either of those, we know we have left the howdoi nav
                    if ($('#nu__main-nav-desktop > ul > li:nth-child(2) > a').is(e.relatedTarget) || $('#nu__main-nav-desktop > ul > li:first-child > a').is(e.relatedTarget)) {
                        Finance.NavHandler._resetHowdoiState();
                    }
                });
                // HomePage Only:
                if (Finance.NavHandler.isHomepage) {
                    // if we blur off the back to topics button
                    $('#howdoi .neumenu-wrapper-inner>div:first-of-type > a').on('blur', function (e) {
                        // and focus is passed to 'about' (which it will be)
                        if ($('#nu__main-nav-desktop > ul > li:last-child > a').is(e.relatedTarget)) {
                            // send focus to the howdoi dropdown item
                            $('#nu__main-nav-desktop > ul > li:first-child > a').focus();
                            Finance.NavHandler._resetHowdoiState();
                        }
                    });
                    // if we blur off the last task view item
                    $('#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li:last-of-type > a').on('blur', function (e) {

                        // if we blur from the last task view item and focus is passed to the learn more button
                        if ($('section.hero > div > a').is(e.relatedTarget)) {
                            // pass focus to the forms top level link
                            $('#nu__main-nav-desktop > ul > li:nth-child(2) > a').focus();
                            Finance.NavHandler._resetHowdoiState();
                        }
                    });
                    // if focus is passed from the first howdoi back to about, redirect it to the logo and reset tabindex
                    $('main > #howdoi > div> div:last-child > div:first-child > a').on('blur', function (e) {
                        if ($('li.has-children:last-child > a').is(e.relatedTarget)) {
                            $('main > #howdoi > div> div:last-child > div > a').attr('tabindex', '-1');
                            $('li.has-children:first-of-type > a').focus();
                        }
                    });
                    $('main > #howdoi > div> div:last-child > div:last-child > a').on('blur', function (e) {
                        // if focus is passed to the learn more button we need to send it to the forms link instead
                        // and reset the tabindex of the howdoi
                        if ($('section.hero a.nu__content_btn').is(e.relatedTarget)) {
                            $('main > #howdoi > div> div:last-child > div > a').attr('tabindex', '-1');
                            $('#nu__main-nav-desktop > ul > li:nth-child(2) > a').focus();
                        }
                    });
                }
            },
            /**
             * 
             * @param {event} e 
             */
            _navInteractionHandler: function (e) {

                
                
                e.stopPropagation();

                if (e.type == "click") {

                    // console.log('clicked on a nav item');
                    
                    // click fires before focus
                    if ($(this).data("justfocussed")) {
                        $(this).data("justfocussed", false);
                    }
                    // click fires on focused element
                    else {
                        // close all dropdowns
                        Finance.NavHandler.dropdownPanels.hide();
                        // remove showme
                        Finance.NavHandler.dropdownPanels.parent('li.has-children').removeClass('neu__showme');
                        // blur this nav item ( to enable clicking it again to focus and reveal its panel)
                        $(this).blur();

                    }
                }
                // is focussed only
                else if (e.type == "focus") {

                    // console.log( 'focused on a nav item ');
                    
                    $(this).data("justfocussed", true);
                    // close all dropdowns
                    Finance.NavHandler.dropdownPanels.hide();
                    // remove all showmes
                    Finance.NavHandler.dropdownPanels.parent('li.has-children').removeClass('neu__showme');
                    Finance.NavHandler._resetHowdoiState();
                    // open this dropdown if available
                    $(this).parent('li.has-children').find('.neumenu-wrapper').show();
                    // add showme here
                    $(this).parent('li.has-children').addClass('neu__showme');
                    // if this is the howdoi menu
                    if ($(this).parent().is('[data-id="howdoi"]')) {
                        // set back to topics tabindex to 0
                        $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:first-of-type>a').attr('tabindex', '0');
                        // set task view tabindex to 0
                        $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li>a').attr('tabindex', '0');
                        // set the category view tabindex to 0
                        $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>a').attr('tabindex', '0');
                    }
                }
                // is blurred
                else {

                    // console.log( 'blurred off a nav item ');
                    
                    $(this).data("justfocussed", false);
                    
                    // close "other" dropdowns
                    $('#nu__main-nav-desktop > ul > li.has-children').not($(this).parent()).find('.neumenu-wrapper').hide();
                    
                    // if focus has NOT shifted to a sub-nav item
                    // (note, on the homepage, there is no subnav to close and this will not affect the howdoi functionality afaik)
                    if ($(this).parent().find(e.relatedTarget).length == 0) {

                        // console.log('what is going on here');
                        
                        // we need to close all nav dropdowns
                        // Finance.NavHandler.dropdownPanels.hide();
                        // remove this showme
                        // Finance.NavHandler.dropdownPanels.parent('li.has-children').removeClass('neu__showme');
                    }


                    //  we are on the home page
                    if (Finance.NavHandler.isHomepage) {
                        // if we blur from the howdoi to the forms
                        if ($(this).parent().is('[data-id="howdoi"]') && $(e.relatedTarget).is('#nu__main-nav-desktop > ul > li:nth-child(2) > a')) {
                            // set the tabindex of the real howdoi items to 0
                            $('main > #howdoi > div> div:last-child > div > a').attr('tabindex', '0');
                            // send focus to the real howdoi first link
                            $('main > #howdoi > div> div:last-child > div:first-child > a').focus();
                        }
                    }
                }
            },
            // resets the HowDoI menu to initial state ( removes filter classes, sets link tabindexes to -1 )
            _resetHowdoiState: function () {
                // remove filtered view from categories
                $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div').removeClass('theFilter');
                // remove filtered view from wrapper
                $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner').removeClass('isFiltered');
                // reset back to topics tabindex
                $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:first-of-type>a').attr('tabindex', '-1');
                // reset task view tabindex
                $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li>a').attr('tabindex', '-1');
                // reset the category view tabindex
                $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>a').attr('tabindex', '-1');
            }

        }
        // Finance.NavHandler._init();




        /**
         * 
         */
        Finance.Nav = {

            parentlinks: $('nav.nu__main-nav > ul > li.has-children > a'),
            dropdowns: $('nav.nu__main-nav > ul > li.has-children'),
            categories: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:last-child > div'),
            backtocats: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:first-child > .removefilter'),

            _init: function () {
                // $('div.wrapper, footer, div#nu__global-footer').on('click', Finance.Nav._didClickOutsideNav);
                Finance.Nav.categories.on('click', Finance.Nav._didClickCategory);
                Finance.Nav.backtocats.on('click', Finance.Nav._didClickBackToCats);
            },
            _didClickBackToCats: function () {
                Finance.Nav.categories.removeClass('theFilter');
                Finance.Nav.categories.parents('.neumenu-wrapper-inner').removeClass('isFiltered');
                $('#nu__main-nav-desktop > ul > li:first-child > a').focus();
            },
            _didClickCategory: function (e) {
                $(this).parents('.neumenu-wrapper-inner').addClass('isFiltered');
                $(this).addClass('theFilter');
                // set tabindex of task items to 0 when entering a category view
                $('#howdoi > div > div:first-child > a').attr('tabindex', '0');
                $(this).find('a').attr('tabindex', '0');

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
            triggers: $('.js__collapsible_list > li > a'),
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