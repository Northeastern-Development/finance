var exceedsContainer=!1;!function(a,e,t){a(function(){a(window).width()<1260?a(".download").removeClass("hvr-shutter-out-horizontal"):a(".download").addClass("hvr-shutter-out-horizontal"),a("#staff").length&&a(".js__bio").magnificPopup({type:"ajax",closeOnContentClick:!1,closeOnBgClick:!1,enableEscapeKey:!1,verticalFit:!0,removalDelay:300,mainClass:"mfp-fade"});var i={},t=0;function s(){a(".nu__section-break").each(function(e){i[a(this).attr("id")]=0==e?0:parseInt(a(this).offset().top+a("header").height()-t)})}function o(e){var t=a(window).scrollTop(),i=t+a(window).height(),s=a(e).offset().top,o;return s+a(e).height()<=i&&t<=s}t=a(window).height()/2,s(),a(window).scroll(function(){a(".nu__col-left ul:not(.noautoscroll) li a").removeClass("active");var e=0;for(var t in i){if(result=o(a("#section-"+e)),result){a(".nu__col-left ul li a").removeClass("active"),a(".nu__col-left ul li a[data-id="+e+"]").addClass("active");break}e++}}),a(".nu__col-left ul:not(.noautoscroll)").on("click","a",function(e){console.log("click"),e.preventDefault();var t=a(this);a(".nu__col-left ul li a").removeClass("active"),a("html,body").animate({scrollTop:i["section-"+t.attr("data-id")]},500,function(){t.addClass("active")})});var e=a(window).width();function n(){if(a(window).width()<=620)a(".nu__filters > div > div").hide(),a(".nu__filters > div > ul > li").removeAttr("style"),a(".nu__filters > div > ul > li").removeClass("inshowmore"),exceedsContainer=!1;else{var e=0,t=a(".nu__filters > div > ul").width(),i=0,s=a(".nu__filters > div > ul > li").first().position().top,o=a(".nu__filters").height()-2;a(".nu__filters > div > ul > li.inshowmore").removeClass("inshowmore"),a(".nu__filters > div > ul > li > a").each(function(e){i+=a(this).outerWidth(),t<i?(a(this).parent().addClass("inshowmore").css({top:o}),o+=a(this).parent().height()):(a(this).parent().removeAttr("style"),a(this).parent().removeClass("inshowmore"))}),t<=i+0?exceedsContainer||(exceedsContainer=!0,a(".nu__filters > div > div").show()):i+0<t&&exceedsContainer&&(exceedsContainer=!1,a(".nu__filters > div > div").hide(),a(".nu__filters > div > ul > li.inshowmore").removeAttr("style"),a(".nu__filters > div > ul > li.inshowmore").removeClass("inshowmore"))}}function l(){a(".js__showmore").hasClass("active")||(a(".js__showmore").addClass("active"),a(".nu__filters > div > ul > li.inshowmore").each(function(){a(this).css({opacity:"1.0"})}),a(".nu__filters").css({overflow:"visible"}))}function r(){a(".js__showmore").hasClass("active")&&(a(".js__showmore").removeClass("active"),a(".nu__filters > div > ul > li.inshowmore").each(function(){a(this).css({opacity:"0.0"})}),a(".nu__filters").css({overflow:"hidden"}))}a("p.testp").text("Screen width is currently: "+e+"px."),a(window).resize(function(){!a("body").hasClass("home")&&0<a(".nu__filters").length&&(n(),r()),t=a(window).height()/2,s(),a(window).width()<1260?a(".download").removeClass("hvr-shutter-out-horizontal"):a(".download").addClass("hvr-shutter-out-horizontal");var e=a(window).width();e<=576?a("p.testp").text("Screen width is less than or equal to 576px. Width is currently: "+e+"px."):e<=680?a("p.testp").text("Screen width is between 577px and 680px. Width is currently: "+e+"px."):e<=1024?a("p.testp").text("Screen width is between 681px and 1024px. Width is currently: "+e+"px."):e<=1500?a("p.testp").text("Screen width is between 1025px and 1499px. Width is currently: "+e+"px."):a("p.testp").text("Screen width is greater than 1500px. Width is currently: "+e+"px.")}),!a("body").hasClass("home")&&0<a(".nu__filters").length&&n(),a(".nu__filters").on("click",".js__showmore",function(e){a(this).hasClass("active")?r():l()})})}(jQuery,this);