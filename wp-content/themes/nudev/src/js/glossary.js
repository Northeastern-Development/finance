Glossary = {

    headheight : $('header').height() + $('div#nu__globalheader').height(),
    jumpnav : $('.glossary-jumpnav'),
    jumplinks : $('.glossary-jumpnav a'),
    initoffset : $('section#glossary').offset().top,
    list : $('.glossary-content'),
    
    _init : function(){
        $(window).on('scroll load', Glossary._scrollHandler);

        Glossary.jumplinks.on('click', Glossary._jumpHandler);
        
    },
    _jumpHandler : function(e){
        e.preventDefault();
        var dest = Glossary.list.find('ul'+e.target.hash).offset().top;
        $(window).scrollTop( dest - Glossary.headheight - Glossary.jumpnav.height() - 40 );
    },
    _scrollHandler : function(e){
        if( $(window).scrollTop() >= Glossary.initoffset - Glossary.headheight ){
            Glossary.jumpnav.addClass('js__jumpnav-fixed');
        } else {
            Glossary.jumpnav.removeClass('js__jumpnav-fixed');
        }
    },
}
Glossary._init();