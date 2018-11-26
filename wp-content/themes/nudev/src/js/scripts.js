var exceedsContainer = false;
var Finance = {};
(function($, root, undefined) {

  $(function() {


    (function ($) {
        $.fn.extend({
            "neumenu": function (parameters) {
                // default parameters
                var defaults = {
                    pos: "list.bottom",
                    classes: "active",
                }

                // combines defaults and parameters
                var options = $.extend({}, defaults, parameters);

                // extension main
                this.each(function () {
                    // get [data-pos=...] attribute
                    var pos = $(this).attr("data-pos");
                    if (pos == undefined) {
                        pos = options.pos;
                    }

                    // get [data-classes=...] attribute
                    var classes = $(this).attr("data-classes");
                    if (classes == undefined) {
                        classes = options.classes;
                    }

                    // get .neumenu-list element
                    var list = $(this);

                    // each .neumenu-item element
                    $(this).find(".neumenu-item").each(function () {


                        // get .neumenu-sub element
                        var sub = $(this).find(".neumenu-sub");
                        if (sub.length == 0) return true;

                        switch (pos) {
                            case "list.right":
                                sub.css({
                                    "top": 0,
                                    "left": 0,
                                    "margin-left": (list.outerWidth() - 1) + "%",
                                    "height": '100%',
                                    "border-left": "none"
                                });
                                break;

                            case "list.left":
                                sub.css({
                                    "top": 0,
                                    "right": 0,
                                    "margin-right": (list.outerWidth() - 1) + "px",
                                    "height": list.outerHeight() + "px",
                                    "border-right": "none"
                                });
                                break;

                            case "list.bottom":
                                sub.css({
                                    "left": 0,
                                    "width": list.outerWidth() + "px"
                                });
                                break;

                            case "list.top":
                                sub.css({
                                    "left": 0,
                                    "width": list.outerWidth() + "px",
                                    "bottom": 0,
                                    "margin-bottom": list.outerHeight() + "px",
                                });
                                break;
                        }

                        //CLICK EVENT
                        $(this).on('click', function () {
                            $('.neumenu-item, .neumenu-sub').removeClass('active')
                            $(this).addClass("active");
                            sub.addClass(classes);
                        });

                        //HOVER EVENT IF THEY WANT IT TO WORK ON HOVER INSTEAD OF CLICK
                        // $(this).mouseenter(function () {
                        //   $(this).addClass("active");
                        //   sub.addClass(classes);
                        //
                        // });
                        //
                        // $(this).mouseleave(function () {
                        //   $(this).removeClass("active");
                        //   sub.removeClass(classes);
                        // });
                    });
                });

                // for chain-style code
                return this;
            }


        });



    })($);

    
    

    //DROPDOWN NAV WITH TAB PANEL
    $('.nu__main-nav > ul > li.has-children ').on('click', function (e) {
        //e.preventDefault();
        var sub = $(this).attr('data-id');

        if (!$(e.target).is("a")) { //was unable to click on any links within the dropdown nav panels. event was bubbling
            e.preventDefault();
        }


        $('li.has-children').removeClass('neu__active'); //removes top nav active state class
        $(this).addClass('neu__active'); //adds top nav active state class to items with drop down menu

        if (sub == 'howdoi') {
            $('#about, .first-sub').css({
                'display': 'none'
            });
            $('#howdoi, .first-sub').css({
                'display': 'block'
            });
        }
        if (sub == 'about') {
            $('#howdoi, .first-sub').css({
                'display': 'none'
            });
            $('#about, .first-sub').css({
                'display': 'block'
            });
        }
    });

    $('main').on('click touchend',function(){
        $('li.has-children').removeClass('neu__active');
        $('#howdoi, .first-sub').css({'display':'none'});
        $('#about, .first-sub').css({'display':'none'});
   });




    $(".neumenu").neumenu(); //THIS CONTROLS TABBED MENU

    $('#about > .neumenu > .neumenu-item').on('click', function (e) {
        $('.neumenu-item').removeClass('active');
    });




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




















































    
    /**
     * Properly set up the Global/Normal Header layout
     * @type {Object}
     */
    Finance.header = {
      glossaryJumpNav: $('.glossary-jumpnav'),
      // set global header
      globalHeader: $('div#nu__globalheader'),
      // set normal header
      normalHeader: $('header.header'),
      // set page content ( to be assigned dynamic margin top )
      pageContent: $('*[role="main"]'),
      _init: function() {
        $(window).on('load', Finance.header._doOffsetHeader);
      },
      _doOffsetHeader: function() {
        var theOffset = null;
        var mainHeaderOffset = null;
        // if we have a global header
        if (Finance.header.globalHeader.length) {
          // combine the 2 header heights
          theOffset = Finance.header.globalHeader.innerHeight() + Finance.header.normalHeader.innerHeight();
          // also pixel perfectly align the normal header flush to the globalheader
          mainHeaderOffset = Finance.header.globalHeader.innerHeight();
        }
        // if we dont have a global header
        else {
          // just use the normal header height to offset
          theOffset = Finance.header.normalHeader.innerHeight();
        }
        // dont adjust styles unless determined
        if (theOffset != null) {
          Finance.header.pageContent.css('margin-top', theOffset);
        }
        // dont adjust styles unless determined
        if (mainHeaderOffset != null) {
          Finance.header.normalHeader.css('top', mainHeaderOffset);
        }
        if (Finance.header.glossaryJumpNav.length) {
          Finance.header.glossaryJumpNav.css('top', theOffset);
        }
      }
    }
    Finance.header._init();


    Finance.glossary = {

      jumpNav : $('.glossary-jumpnav'),
      jumpNavLinks : $('.glossary-jumpnav a'),
      contentAnchors : $('.glossary-content > ul'),

      _init: function() {
        // Finance.glossary.jumpNavLinks.on('click', Finance.glossary._jumpToOffsetPosition);
        $(window).on('hashchange', Finance.glossary._jumpToOffsetPosition);
      },
      _jumpToOffsetPosition : function(e){




      }
    }
    // Finance.glossary._init();









    if ($(window).width() < 1260) {
      $('.download').removeClass('hvr-shutter-out-horizontal');
    } else {
      $('.download').addClass('hvr-shutter-out-horizontal');
    }

    //$('.download').removeClass('hvr-shutter-out-horizontal');






    // if we are on the staff page, allow for some links to open full bio details in a lightbox
    if ($("#staff").length) {

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



    }






    // the following deals with the auto scrolling of long pages
    var pageSections = {};
    var targetOffset = 0;

    targetOffset = ($(window).height() / 2); // half the height of the browser window, needs to be re-calculated on page re-size!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //console.log(targetOffset);

    //console.log("HEADER: "+$("header").height());

    function getScrollSections() {
      $(".nu__section-break").each(function(i) {
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

    $(window).scroll(function() {
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
    $(".nu__col-left ul:not(.noautoscroll)").on("click", "a", function(e) {
      console.log("click");
      e.preventDefault();
      var t = $(this);
      $(".nu__col-left ul li a").removeClass("active");
      $("html,body").animate({
        scrollTop: pageSections["section-" + t.attr("data-id")]
      }, 500, function() {
        t.addClass("active");
      });
    });



    /*Remove the lines below once you are done testing*/
    var wi = $(window).width();
    $("p.testp").text('Screen width is currently: ' + wi + 'px.');

    $(window).resize(function() {

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

        $('.nu__filters > div > ul > li > a').each(function(i) {
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
        $('.nu__filters > div > ul > li.inshowmore').each(function() {
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
        $('.nu__filters > div > ul > li.inshowmore').each(function() {
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
    $('.nu__filters').on('click', '.js__showmore', function(e) {

      // console.log('I would like to see more!');

      // showHideMore();

      // $('.nu__filters ul').height('auto');

      if (!$(this).hasClass('active')) {
        showMoreFilters();
      } else {
        hideMoreFilters();
      }

    });


        $(".js__video-popup").magnificPopup({
            type: "ajax"
            ,closeOnContentClick: false
            ,closeOnBgClick: false
            ,enableEscapeKey: false
            ,verticalFit: true
            ,removalDelay: 300
            ,mainClass: 'mfp-fade'
        });


    // MAGNIFIC STUFF FOR STAFF / DEPARTMENTS
    // if($("#staff").length){

        $(".js__bio").magnificPopup({
            type: "ajax"
            ,closeOnContentClick: false
            ,closeOnBgClick: false
            ,enableEscapeKey: false
            ,verticalFit: true
            ,removalDelay: 300
            ,mainClass: 'mfp-fade'
        });
    // }
    
    
    

  });

})(jQuery, this);
