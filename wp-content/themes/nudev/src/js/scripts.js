var exceedsContainer = false;
var Finance = {};
(function ($, root, undefined) {
    $(function () {


        Finance.JumpNav = {

            _init : function(){
                // on load wont work because collapsibles are open on load, and closed by a jquery function immediately after
                // instead, on load is handled by the collapsibles loadhandler (Finance.faqs._loadHandler)
                    // $(window).on('load', Finance.JumpNav._doHashHandler);]
                // the on hash change event handler works when a hash is entered into the already loaded page
                $(window).on('hashchange', Finance.JumpNav._doHashHandler);
            },
            _doHashHandler : function(e){

                var hash = window.location.hash.substring(1);
                if( !hash ){
                    return;
                }
                var headheight = $('div#nu__globalheader').height() + $('header').height();
                var baseoffset = $('#'+hash).offset().top;
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


        Finance.Nav = {

            parentlinks: $('nav.nu__main-nav > ul > li.has-children > a'),
            dropdowns: $('nav.nu__main-nav > ul > li.has-children'),
            categories: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:last-child > div'),
            backtocats: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:first-child > .removefilter'),
            // tasks : $(),

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
                    Finance.Nav._collapseDropdowns();

                    // good place to help out the mobile nav too
                    $('#neu__navicon').removeAttr('checked');
                    $('#nu__mobile a.active').removeClass('active');
                    $('#nu__mobile .show').hide();
                    $('#nu__mobile .show').removeClass('show');
                    $('html, body').removeClass('neu__noscroll');

                }
            },
            _collapseDropdowns: function () {
                $('li.has-children').find('.neumenu-wrapper').hide();
                $('li.has-children').find('.isFiltered').removeClass('isFiltered');
                $('li.has-children').find('.theFilter').removeClass('theFilter');

                Finance.Nav.dropdowns.removeClass('neu__showme');
            },
            _didClickDropdown: function (e) {
                e.stopPropagation();
                e.preventDefault();

                // if the other dropdown is visible,
                if (!$(this).parent().siblings('.has-children').find('.neumenu-wrapper').is(':hidden')) {
                    // hide the other dropdown
                    $(this).parent().siblings('.has-children').find('.neumenu-wrapper').hide();
                }

                // if the other dropdown has a showme class
                if ($(this).parent().siblings('.has-children').hasClass('neu__showme')) {
                    $(this).parent().siblings('.has-children').removeClass('neu__showme');
                }

                // if this dropdown is hidden,
                if ($(this).parent().find('.neumenu-wrapper').is(':hidden')) {
                    // show this dropdown
                    $(this).parent().find('.neumenu-wrapper').show();
                    // when this dropdown is shown; apply a showme class
                    $(this).parent().addClass('neu__showme');
                }
                // if this dropdown is visible,
                else {
                    // hide this dropdown
                    $(this).parent().find('.neumenu-wrapper').hide();
                    // when this dropdown is hidden, remove the showme class
                    $(this).parent().removeClass('neu__showme');
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
    });
})(jQuery, this);