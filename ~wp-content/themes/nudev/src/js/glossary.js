// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {



        Finance.Glossary = {

            offsetHeader : $('div#nu__globalheader').outerHeight() + $('header.header').outerHeight(),

            offsetHeroAndHeader : $('div#nu__globalheader').outerHeight() + $('header.header').outerHeight() + $('section.hero').outerHeight(),

            offsetHero : $('section.hero').outerHeight(),

            jumpNav : $('div.glossary-jumpnav'),

            jumpLinks : $('div.glossary-jumpnav > span > a'),

            
            _init : function(){
                $(window).on('scroll', Finance.Glossary._scrollHandler );
                $(window).on('load', Finance.Glossary._loadHandler );
                Finance.Glossary.jumpLinks.on('click', Finance.Glossary._jumpHandler);
                
            },
            _loadHandler : function(e){
                // check where we have scrolled to and do stuff
            },
            _scrollHandler : function(e){
                if( $(window).scrollTop() >= Finance.Glossary.offsetHero ){
                    Finance.Glossary.jumpNav.addClass('js__glossnav_sticky');
                } else {
                    Finance.Glossary.jumpNav.removeClass('js__glossnav_sticky');
                }
            },
            _jumpHandler : function(e){

                e.preventDefault();

                var jumpFrom = $(this).attr('href');
                var jumpTo = $('div.glossary-content > ul'+jumpFrom).offset().top;

                $('html, body').scrollTop(jumpTo - Finance.Glossary.offsetHeader - 120);
                
            }
            
        };
        Finance.Glossary._init();


    });
})(jQuery, this);