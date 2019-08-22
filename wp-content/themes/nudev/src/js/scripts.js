var exceedsContainer = false;
var Finance = {};
(function ($, root, undefined) {
    $(function(){

        $(document).ready(function(){

            // if collapsible fields are present:
            if( $('.js__collapsible_list').length ){

                Finance.Collapsibles = {

                    // initialize collapsibles handler -- add event listeners
                    _init : function(){

                        $('.js__collapsible_list > li > a').on('click', Finance.Collapsibles._clickHandler);
                        
                    }

                    // click Handler (clicked collapsible list triggering element)
                    ,_clickHandler : function(e){

                        // get 'this' collapsible field
                        thisAnswer = $(this).siblings('div');
                        // get the 'other' collapsible fields
                        otherAnswers = $('.js__collapsible_list > li > div').not(thisAnswer);

                        // unset active class from 'other' collapsible fields
                        $(otherAnswers).parent('li').removeClass('js__collapsible_triggered');  // remove the 'triggered' class from the collapsible field container
                        $(otherAnswers).removeClass('js__collapsible_opened');                  // remove the 'open' class from the collapsible field
                        
                        
                        // this collapsible is open
                        if( $(this).parent('li').hasClass('js__collapsible_triggered') ){

                            // add the 'opened' class to the div we hide/show
                            $(this).siblings('div').removeClass('js__collapsible_opened');
                            // add the 'triggered' class to the collapsible container - to adjust styles for the chevron and underline etc.
                            $(this).parent('li').removeClass('js__collapsible_triggered');

                            // we are closing a collapsible;
                            if( $(this).siblings('a.named_anchor').length ){

                                // try to use history api
                                if(history.replaceState) {
                                    // use replacestate to update URL (prevents scrolling and reloading)
                                    history.replaceState(null, null, ' ');
                                }
                                // history api unavailable browser < ie9
                                else {
                                    location.hash = '';
                                }
                            }
                        }
                        // this collapsible is closed
                        else {
                            // add the 'opened' class to the div we hide/show
                            $(this).siblings('div').addClass('js__collapsible_opened');
                            // add the 'triggered' class to the collapsible container - to adjust styles for the chevron and underline etc.
                            $(this).parent('li').addClass('js__collapsible_triggered');

                            

                            // we are opening a collapsible;
                            if( $(this).siblings('a.named_anchor').length ){

                                // if this collapsible has a named anchor
                                // (after weve opened it); push that named anchor into the url

                                window.location.hash = $(this).siblings('a.named_anchor')[0].id;

                            }
                        }
                    }
                }

                // initialize collapsibles handler
                Finance.Collapsibles._init();
            }
            
            
            
                
            // 
            // URL has hash
            if( window.location.hash ){

                // handle hash behavior
                Finance.HashHandler = {
    
                    // init sets event listeners that fire later
                    _init : function(){
    
                        $(window).on('load', function(e){

                            // check that we have collapsibles to expand/contract
                            if( $('.js__collapsible_list').length ){
                                
                                // get the hash target on load, and on hashchange
                                var hashTarget = $('a.named_anchor:target');
    
                                var hashNotTarget = $('a.named_anchor:not(:target)');

                                // close all the collapsibles
                                // this is mirroring the 'opening' behavior rather than find the collapsibles another way; to keep it consistent
                                hashNotTarget.parent('li').removeClass('js__collapsible_triggered');
                                // hashNotTarget.siblings('div').css('display', 'none');
                                hashNotTarget.siblings('div').removeClass('js__collapsible_opened');
                                
                                // open the target collapsible
                                hashTarget.parent('li').addClass('js__collapsible_triggered');
                                // hashTarget.siblings('div').css('display', 'block');
                                hashTarget.siblings('div').addClass('js__collapsible_opened');
    
                                // then, only on hash change
                                // we need to manually rescroll the page to account for collapsing / expanding elements
                                if( e.type == 'hashchange' && hashTarget.length ){
                                    
                                    $(window).scrollTop( hashTarget.offset().top );
    
                                }
                            }
                        });
                    }
                }
                Finance.HashHandler._init();
                
            }
            

        });

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
        
        
        /**
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
                    $(this).data("justfocussed", false);
                    // close "other" dropdowns
                    $('#nu__main-nav-desktop > ul > li.has-children').not($(this).parent()).find('.neumenu-wrapper').hide();
                    // if focus has NOT shifted to a sub-nav item
                    // (note, on the homepage, there is no subnav to close and this will not affect the howdoi functionality afaik)
                    if ($(this).parent().find(e.relatedTarget).length == 0) {
                        // we need to close all nav dropdowns
                        Finance.NavHandler.dropdownPanels.hide();
                        // remove this showme
                        Finance.NavHandler.dropdownPanels.parent('li.has-children').removeClass('neu__showme');
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
        Finance.NavHandler._init();

        /**
         * 
         */
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



                // reset back to topics tabindex
                // $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:first-of-type>a').attr('tabindex', '-1');
                // reset task view tabindex
                // $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li>a').attr('tabindex', '-1');
                // reset the category view tabindex
                // $('.neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>a').attr('tabindex', '-1');

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
        






        // BOTH OF THESE HAVE BEEN DEPRICATED!
        // THESE FUNCTIONS ARE NOT IN USE!
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
        // Finance.JumpNav._init();  // depricated
        Finance.faqs = {
            triggers: $('.js__collapsible_list > li > a'),
            questions: $('.js__collapsible_list > li'),
            answers: $('.js__collapsible_list > li > div'),
            _init: function () {
                
                Finance.faqs.triggers.on('click', Finance.faqs._clickHandler);
                
                // $(window).on('load', Finance.faqs._loadHandler);
            },

            // THIS IS DISABLED! STOP LOOKING AT IT!  
            _loadHandler: function (e) {
                // Finance.faqs.answers.slideUp(0);
                $('a.named_anchor:target').parent('li').addClass('js__collapsible_triggered');
                $('a.named_anchor:target').siblings('div').slideDown(200);
                $('a.named_anchor:target').siblings('div').addClass('js__collapsible_opened');
                // Finance.JumpNav._doHashHandler();
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
        // Finance.faqs._init();    // depricated



    });
})(jQuery, this);