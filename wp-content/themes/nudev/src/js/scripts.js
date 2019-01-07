var exceedsContainer = false;
var Finance = {};
(function ($, root, undefined) {
    $(function () {


        Finance.faqs = {
            questions :  $('.js__collapsible_list > li'),
            answers :  $('.js__collapsible_list > li > div'),
            _init : function(){
                $(window).on('load', Finance.faqs._loadHandler);
                Finance.faqs.questions.on('click', Finance.faqs._clickHandler);
            },
            _loadHandler : function(e){
                Finance.faqs.answers.slideUp(0);
            },
            _clickHandler : function(e){
                //  (possible to easily tighten this up)
                var open = "js__collapsible_opened";
                var thisAnswer = $(this).find('div');
                var otherAnswers = Finance.faqs.answers.not(thisAnswer);
                
                $(otherAnswers).removeClass(open);
                $(otherAnswers).slideUp();
                
                if( !$(thisAnswer).hasClass(open) ){
                    $(thisAnswer).addClass(open);
                    $(thisAnswer).slideDown();
                } else {
                    $(thisAnswer).removeClass(open);
                    $(thisAnswer).slideUp();
                }
            }
        }
        Finance.faqs._init();
        


        // Handle the Main Navigation:
        Finance.Navigation = {
            // vars
            howdoi_wrapper : $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner'),
            howdoi_items : $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:last-child > div'),
            howdoi_reset: $('#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:first-child > .removefilter'),
            
            toplvl_nochild : $('nav.nu__main-nav > ul > li:not(.has-children) > a'),
            toplvl_haschild : $('nav.nu__main-nav > ul > li.has-children > a'),
            
            // init
            _init : function(){
                // code here...
                Finance.Navigation.howdoi_items.on('click', Finance.Navigation._filterHandler);
                Finance.Navigation.howdoi_reset.on('click', Finance.Navigation._unFilterHandler);
                Finance.Navigation.toplvl_haschild.on('click', Finance.Navigation._dropDownHandler);
            },
            // methods
            _filterHandler : function(e){
                Finance.Navigation.howdoi_wrapper.addClass('isFiltered');
                $(this).addClass('theFilter');
            },
            _unFilterHandler : function(e){
                Finance.Navigation.howdoi_wrapper.find('.theFilter').removeClass('theFilter');
                Finance.Navigation.howdoi_wrapper.removeClass('isFiltered');
            },
            _dropDownHandler : function(e){
                e.preventDefault();


                if( !$(this).parent().hasClass('neu__active') ){
                    $(this).parent().addClass('neu__active');
                } else {
                    $(this).parent().removeClass('neu__active');
                }

                $('li.has-children').find('.neumenu-wrapper').hide();
                $('li.has-children.neu__active').find('.neumenu-wrapper').show();
            }
        }
        Finance.Navigation._init();










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





























        if ($(window).width() < 1260) {
            $('.download').removeClass('hvr-shutter-out-horizontal');
        } else {
            $('.download').addClass('hvr-shutter-out-horizontal');
        }

        //$('.download').removeClass('hvr-shutter-out-horizontal');






        // if we are on the staff page, allow for some links to open full bio details in a lightbox
        // if ($("#staff").length) {
        $(".js__bio").magnificPopup({
            // type: "iframe"
            type: "ajax",
            closeOnContentClick: false,
            closeOnBgClick: false,
            enableEscapeKey: false,
            verticalFit: true,
            removalDelay: 300,
            mainClass: 'mfp-fade'
            // ,callbacks:{
            //   beforeOpen: function() {
            //     console.log('Start of popup initialization');
            //   }
            // }
        });
        // }






        // the following deals with the auto scrolling of long pages
        var pageSections = {};
        var targetOffset = 0;

        targetOffset = ($(window).height() / 2); // half the height of the browser window, needs to be re-calculated on page re-size!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //console.log(targetOffset);

        //console.log("HEADER: "+$("header").height());

        function getScrollSections() {
            $(".nu__section-break").each(function (i) {
                if (i == 0) {
                    pageSections[$(this).attr("id")] = 0;
                } else {
                    pageSections[$(this).attr("id")] = parseInt(($(this).offset().top) + $("header").height() - targetOffset);
                }
            });
        }

        getScrollSections();
        //console.log(pageSections);


        // this is the function that will check if the element is on the screen or not
        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        $(window).scroll(function () {
            $(".nu__col-left ul:not(.noautoscroll) li a").removeClass("active");
            var i = 0;
            for (var p in pageSections) {
                result = isScrolledIntoView($("#section-" + i));

                if (result) {
                    //console.log("SECTION-"+i+": "+result);
                    $(".nu__col-left ul li a").removeClass("active");
                    $(".nu__col-left ul li a[data-id=" + i + "]").addClass("active");
                    break;
                }
                i++;
            }
        });

        // when a user clicks on one of the sub-nav options to scroll the page
        $(".nu__col-left ul:not(.noautoscroll)").on("click", "a", function (e) {
            console.log("click");
            e.preventDefault();
            var t = $(this);
            $(".nu__col-left ul li a").removeClass("active");
            $("html,body").animate({
                scrollTop: pageSections["section-" + t.attr("data-id")]
            }, 500, function () {
                t.addClass("active");
            });
        });



        /*Remove the lines below once you are done testing*/
        var wi = $(window).width();
        $("p.testp").text('Screen width is currently: ' + wi + 'px.');

        $(window).resize(function () {

            // if we are NOT on the homepage, kick off a filter check
            if (!$('body').hasClass('home') && $('.nu__filters').length > 0) {
                filterNavCheck(); // check to see what needs to be shown and what is overflow for filters
                hideMoreFilters(); // hide the additional filters if they are visible
            }

            targetOffset = ($(window).height() / 2);

            getScrollSections();

            if ($(window).width() < 1260) {
                $('.download').removeClass('hvr-shutter-out-horizontal');
            } else {
                $('.download').addClass('hvr-shutter-out-horizontal');
            }



            /*Remove the lines below once you are done testing*/
            var wi = $(window).width();

            if (wi <= 576) {
                $("p.testp").text('Screen width is less than or equal to 576px. Width is currently: ' + wi + 'px.');
            } else if (wi <= 680) {
                $("p.testp").text('Screen width is between 577px and 680px. Width is currently: ' + wi + 'px.');
            } else if (wi <= 1024) {
                $("p.testp").text('Screen width is between 681px and 1024px. Width is currently: ' + wi + 'px.');
            } else if (wi <= 1500) {
                $("p.testp").text('Screen width is between 1025px and 1499px. Width is currently: ' + wi + 'px.');
            } else {
                $("p.testp").text('Screen width is greater than 1500px. Width is currently: ' + wi + 'px.');
            }
        });



        // this function will check filter navs used on pages to see if the items exceed the width of the container
        function filterNavCheck() {

            if ($(window).width() <= 620) { // we are on a much smaller screen, so ignore the more option and stack via CSS
                // console.log('screen size less than 620px');
                $('.nu__filters > div > div').hide();
                $('.nu__filters > div > ul > li').removeAttr('style');
                $('.nu__filters > div > ul > li').removeClass('inshowmore');
                exceedsContainer = false;
            } else { // we need to use the more option to allow user to see all options

                // $('.nu__filters > div > div').show();	// we need to show the more option

                var offset = 0;
                var filterWidth = $('.nu__filters > div > ul').width();

                // total up the width of all of the filter options
                var itemWidth = 0;
                var tPos = $('.nu__filters > div > ul > li').first().position().top;
                //console.log(tPos);
                var vOffset = ($('.nu__filters').height() - 2);

                // console.log(vOffset);

                // $('.nu__filters > div > ul > li.inshowmore').removeAttr('style');
                // $('.nu__filters > div > ul > li.inshowmore').removeClass('inshowmore');

                // $('.nu__filters > div > ul > li.inshowmore').removeAttr('style');
                $('.nu__filters > div > ul > li.inshowmore').removeClass('inshowmore');

                $('.nu__filters > div > ul > li > a').each(function (i) {
                    itemWidth += $(this).outerWidth();
                    //console.log($(this).parent().position().top);
                    // if($(this).parent().position().top > tPos){
                    if (itemWidth > filterWidth) {
                        //console.log($(this));
                        $(this).parent().addClass('inshowmore').css({
                            'top': vOffset
                        });
                        vOffset += $(this).parent().height();
                    } else {

                        // need to re-check the position vs width here to remove styles if no longer hiding

                        // $('.nu__filters > div > ul > li.inshowmore').removeAttr('style');
                        // $('.nu__filters > div > ul > li.inshowmore').removeClass('inshowmore');
                        // // $(this).parent().removeClass('inshowmore').css({'top':vOffset});
                        // vOffset -= $(this).parent().height();
                        $(this).parent().removeAttr('style');
                        $(this).parent().removeClass('inshowmore');
                    }
                });

                // now let's figure out if the content fits inside the container or not
                if ((itemWidth + offset) >= filterWidth) {
                    if (!exceedsContainer) {
                        // console.log('content exceeds container!');
                        exceedsContainer = true;

                        // let's show the more button as the items do not fit
                        $('.nu__filters > div > div').show();

                    }
                } else if ((itemWidth + offset) < filterWidth) {
                    if (exceedsContainer) {
                        // console.log('content fits within container again!');
                        exceedsContainer = false;

                        // more than enough room, hide the more button
                        $('.nu__filters > div > div').hide();

                        $('.nu__filters > div > ul > li.inshowmore').removeAttr('style');
                        $('.nu__filters > div > ul > li.inshowmore').removeClass('inshowmore');

                    }
                }
            }
        }

        // if we are NOT on the homepage, kick off a filter check right away
        if (!$('body').hasClass('home') && $('.nu__filters').length > 0) {
            filterNavCheck();
        }




        function showMoreFilters() {
            if (!$('.js__showmore').hasClass('active')) {
                $('.js__showmore').addClass('active');
                $('.nu__filters > div > ul > li.inshowmore').each(function () {
                    $(this).css({
                        'opacity': '1.0'
                    });
                });
                $('.nu__filters').css({
                    'overflow': 'visible'
                });
            }
        }

        function hideMoreFilters() {
            if ($('.js__showmore').hasClass('active')) {
                $('.js__showmore').removeClass('active');
                $('.nu__filters > div > ul > li.inshowmore').each(function () {
                    $(this).css({
                        'opacity': '0.0'
                    });
                });
                $('.nu__filters').css({
                    'overflow': 'hidden'
                });
            }
        }

        // this will handle clicking on the more button in filter options
        $('.nu__filters').on('click', '.js__showmore', function (e) {

            // console.log('I would like to see more!');

            // showHideMore();

            // $('.nu__filters ul').height('auto');

            if (!$(this).hasClass('active')) {
                showMoreFilters();
            } else {
                hideMoreFilters();
            }

        });


        $('.js__youtube').magnificPopup({
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

                patterns: {
                    youtube: {
                        index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                        id: 'v=', // String that splits URL in a two parts, second part should be %id%
                        // Or null - full URL will be returned
                        // Or a function that should return %id%, for example:
                        // id: function(url) { return 'parsed id'; }

                        src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                    }
                },
                srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
            }
        });

    });
})(jQuery, this);