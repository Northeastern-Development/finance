var exceedsContainer=!1,Finance={};!function(h,e,d){h(function(){var a;(a=h).fn.extend({neumenu:function(e){var t={pos:"list.bottom",classes:"active"},s=a.extend({},t,e);return this.each(function(){var t=a(this).attr("data-pos");t==d&&(t=s.pos);var i=a(this).attr("data-classes");i==d&&(i=s.classes);var n=a(this);a(this).find(".neumenu-item").each(function(){var e=a(this).find(".neumenu-sub");if(0==e.length)return!0;switch(t){case"list.right":e.css({top:0,left:0,"margin-left":n.outerWidth()-1+"%",height:"100%","border-left":"none"});break;case"list.left":e.css({top:0,right:0,"margin-right":n.outerWidth()-1+"px",height:n.outerHeight()+"px","border-right":"none"});break;case"list.bottom":e.css({left:0,width:n.outerWidth()+"px"});break;case"list.top":e.css({left:0,width:n.outerWidth()+"px",bottom:0,"margin-bottom":n.outerHeight()+"px"})}a(this).on("click",function(){a(".neumenu-item, .neumenu-sub").removeClass("active"),a(this).addClass("active"),e.addClass(i)})})}),this}}),h(".nu__main-nav > ul > li.has-children ").on("click",function(e){var t=h(this).attr("data-id");h(e.target).is("a")||e.preventDefault(),h(this).hasClass("neu__active")||h(this).hasClass("neu__active")||h(this).addClass("neu__active"),"howdoi"==t&&(h("#about, .first-sub").css({display:"none"}),h("#howdoi, .first-sub").css({display:"block"})),"about"==t&&(h("#howdoi, .first-sub").css({display:"none"}),h("#about, .first-sub").css({display:"block"}))}),h(".neumenu").neumenu(),h("#about > .neumenu > .neumenu-item").on("click",function(e){h(".neumenu-item").removeClass("active")}),h(".js-mobile-nav").click(function(e){e.preventDefault();var t=h(this);t.next().hasClass("show")?(t.next().removeClass("show"),t.removeClass("active"),t.next().slideUp(350)):(t.parent().parent().find("li .inner").removeClass("show"),t.hasClass("parent")?t.parents("#nu__mobile > nav ul").find(".toggle").removeClass("active"):t.hasClass("child")?t.parents("#nu__mobile > nav ul").find(".toggle.child").removeClass("active"):t.parents("#nu__mobile > nav ul").find(".toggle.child-child").removeClass("active"),t.parent().parent().find("li .inner").slideUp(350),t.next().toggleClass("show"),t.addClass("active"),t.next().slideToggle(350))}),Finance.header={glossaryJumpNav:h(".glossary-jumpnav"),globalHeader:h("div#nu__globalheader"),normalHeader:h("header.header"),pageContent:h('*[role="main"]'),_init:function(){h(window).on("load",Finance.header._doOffsetHeader)},_doOffsetHeader:function(){var e=null,t=null;Finance.header.globalHeader.length?(e=Finance.header.globalHeader.innerHeight()+Finance.header.normalHeader.innerHeight(),t=Finance.header.globalHeader.innerHeight()):e=Finance.header.normalHeader.innerHeight(),null!=e&&Finance.header.pageContent.css("margin-top",e),null!=t&&Finance.header.normalHeader.css("top",t),Finance.header.glossaryJumpNav.length&&Finance.header.glossaryJumpNav.css("top",e)}},Finance.header._init(),Finance.glossary={jumpNav:h(".glossary-jumpnav"),jumpNavLinks:h(".glossary-jumpnav a"),contentAnchors:h(".glossary-content > ul"),_init:function(){h(window).on("hashchange",Finance.glossary._jumpToOffsetPosition)},_jumpToOffsetPosition:function(e){}},h(window).width()<1260?h(".download").removeClass("hvr-shutter-out-horizontal"):h(".download").addClass("hvr-shutter-out-horizontal"),h("#staff").length&&h(".js__bio").magnificPopup({type:"ajax",closeOnContentClick:!1,closeOnBgClick:!1,enableEscapeKey:!1,verticalFit:!0,removalDelay:300,mainClass:"mfp-fade"});var i={},t=0;function n(){h(".nu__section-break").each(function(e){i[h(this).attr("id")]=0==e?0:parseInt(h(this).offset().top+h("header").height()-t)})}function s(e){var t=h(window).scrollTop(),i=t+h(window).height(),n=h(e).offset().top,s;return n+h(e).height()<=i&&t<=n}t=h(window).height()/2,n(),h(window).scroll(function(){h(".nu__col-left ul:not(.noautoscroll) li a").removeClass("active");var e=0;for(var t in i){if(result=s(h("#section-"+e)),result){h(".nu__col-left ul li a").removeClass("active"),h(".nu__col-left ul li a[data-id="+e+"]").addClass("active");break}e++}}),h(".nu__col-left ul:not(.noautoscroll)").on("click","a",function(e){console.log("click"),e.preventDefault();var t=h(this);h(".nu__col-left ul li a").removeClass("active"),h("html,body").animate({scrollTop:i["section-"+t.attr("data-id")]},500,function(){t.addClass("active")})});var e=h(window).width();function o(){if(h(window).width()<=620)h(".nu__filters > div > div").hide(),h(".nu__filters > div > ul > li").removeAttr("style"),h(".nu__filters > div > ul > li").removeClass("inshowmore"),exceedsContainer=!1;else{var e=0,t=h(".nu__filters > div > ul").width(),i=0,n=h(".nu__filters > div > ul > li").first().position().top,s=h(".nu__filters").height()-2;h(".nu__filters > div > ul > li.inshowmore").removeClass("inshowmore"),h(".nu__filters > div > ul > li > a").each(function(e){i+=h(this).outerWidth(),t<i?(h(this).parent().addClass("inshowmore").css({top:s}),s+=h(this).parent().height()):(h(this).parent().removeAttr("style"),h(this).parent().removeClass("inshowmore"))}),t<=i+0?exceedsContainer||(exceedsContainer=!0,h(".nu__filters > div > div").show()):i+0<t&&exceedsContainer&&(exceedsContainer=!1,h(".nu__filters > div > div").hide(),h(".nu__filters > div > ul > li.inshowmore").removeAttr("style"),h(".nu__filters > div > ul > li.inshowmore").removeClass("inshowmore"))}}function l(){h(".js__showmore").hasClass("active")||(h(".js__showmore").addClass("active"),h(".nu__filters > div > ul > li.inshowmore").each(function(){h(this).css({opacity:"1.0"})}),h(".nu__filters").css({overflow:"visible"}))}function r(){h(".js__showmore").hasClass("active")&&(h(".js__showmore").removeClass("active"),h(".nu__filters > div > ul > li.inshowmore").each(function(){h(this).css({opacity:"0.0"})}),h(".nu__filters").css({overflow:"hidden"}))}h("p.testp").text("Screen width is currently: "+e+"px."),h(window).resize(function(){!h("body").hasClass("home")&&0<h(".nu__filters").length&&(o(),r()),t=h(window).height()/2,n(),h(window).width()<1260?h(".download").removeClass("hvr-shutter-out-horizontal"):h(".download").addClass("hvr-shutter-out-horizontal");var e=h(window).width();e<=576?h("p.testp").text("Screen width is less than or equal to 576px. Width is currently: "+e+"px."):e<=680?h("p.testp").text("Screen width is between 577px and 680px. Width is currently: "+e+"px."):e<=1024?h("p.testp").text("Screen width is between 681px and 1024px. Width is currently: "+e+"px."):e<=1500?h("p.testp").text("Screen width is between 1025px and 1499px. Width is currently: "+e+"px."):h("p.testp").text("Screen width is greater than 1500px. Width is currently: "+e+"px.")}),!h("body").hasClass("home")&&0<h(".nu__filters").length&&o(),h(".nu__filters").on("click",".js__showmore",function(e){h(this).hasClass("active")?r():l()})})}(jQuery,this);