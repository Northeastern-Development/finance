var exceedsContainer=!1,Finance={};!function(l,e,n){l(function(){Finance.NavHandler={isHomepage:0<l("main > div#howdoi").length,navItems:l("#nu__main-nav-desktop > ul > li > a"),dropdownPanels:l("li.has-children > .neumenu-wrapper"),_init:function(){Finance.NavHandler.navItems.on("focus blur click",Finance.NavHandler._navInteractionHandler),l("#nu__main-nav-desktop > ul > li:last-child > .neumenu-wrapper > div > a:last-child").on("blur",function(e){0==l(this).parent().find(l(e.relatedTarget)).length&&(Finance.NavHandler.dropdownPanels.hide(),Finance.NavHandler.dropdownPanels.parent("li.has-children").removeClass("neu__showme"))}),l("#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li:last-of-type > a, #howdoi .neumenu-wrapper-inner>div:first-of-type > a").on("blur",function(e){(l("#nu__main-nav-desktop > ul > li:nth-child(2) > a").is(e.relatedTarget)||l("#nu__main-nav-desktop > ul > li:first-child > a").is(e.relatedTarget))&&Finance.NavHandler._resetHowdoiState()}),Finance.NavHandler.isHomepage&&(l("#howdoi .neumenu-wrapper-inner>div:first-of-type > a").on("blur",function(e){l("#nu__main-nav-desktop > ul > li:last-child > a").is(e.relatedTarget)&&(l("#nu__main-nav-desktop > ul > li:first-child > a").focus(),Finance.NavHandler._resetHowdoiState())}),l("#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li:last-of-type > a").on("blur",function(e){l("section.hero > div > a").is(e.relatedTarget)&&(l("#nu__main-nav-desktop > ul > li:nth-child(2) > a").focus(),Finance.NavHandler._resetHowdoiState())}),l("main > #howdoi > div> div:last-child > div:first-child > a").on("blur",function(e){l("li.has-children:last-child > a").is(e.relatedTarget)&&(l("main > #howdoi > div> div:last-child > div > a").attr("tabindex","-1"),l("li.has-children:first-of-type > a").focus())}),l("main > #howdoi > div> div:last-child > div:last-child > a").on("blur",function(e){l("section.hero a.nu__content_btn").is(e.relatedTarget)&&(l("main > #howdoi > div> div:last-child > div > a").attr("tabindex","-1"),l("#nu__main-nav-desktop > ul > li:nth-child(2) > a").focus())}))},_navInteractionHandler:function(e){e.stopPropagation(),"click"==e.type?l(this).data("justfocussed")?l(this).data("justfocussed",!1):(Finance.NavHandler.dropdownPanels.hide(),Finance.NavHandler.dropdownPanels.parent("li.has-children").removeClass("neu__showme"),l(this).blur()):"focus"==e.type?(l(this).data("justfocussed",!0),Finance.NavHandler.dropdownPanels.hide(),Finance.NavHandler.dropdownPanels.parent("li.has-children").removeClass("neu__showme"),Finance.NavHandler._resetHowdoiState(),l(this).parent("li.has-children").find(".neumenu-wrapper").show(),l(this).parent("li.has-children").addClass("neu__showme"),l(this).parent().is('[data-id="howdoi"]')&&(l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:first-of-type>a").attr("tabindex","0"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li>a").attr("tabindex","0"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>a").attr("tabindex","0"))):(l(this).data("justfocussed",!1),l("#nu__main-nav-desktop > ul > li.has-children").not(l(this).parent()).find(".neumenu-wrapper").hide(),0==l(this).parent().find(e.relatedTarget).length&&(Finance.NavHandler.dropdownPanels.hide(),Finance.NavHandler.dropdownPanels.parent("li.has-children").removeClass("neu__showme")),Finance.NavHandler.isHomepage&&l(this).parent().is('[data-id="howdoi"]')&&l(e.relatedTarget).is("#nu__main-nav-desktop > ul > li:nth-child(2) > a")&&(l("main > #howdoi > div> div:last-child > div > a").attr("tabindex","0"),l("main > #howdoi > div> div:last-child > div:first-child > a").focus()))},_resetHowdoiState:function(){l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div").removeClass("theFilter"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner").removeClass("isFiltered"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:first-of-type>a").attr("tabindex","-1"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>ul>li>a").attr("tabindex","-1"),l(".neumenu-wrapper#howdoi .neumenu-wrapper-inner>div:last-of-type>div>a").attr("tabindex","-1")}},Finance.NavHandler._init(),Finance.Nav={parentlinks:l("nav.nu__main-nav > ul > li.has-children > a"),dropdowns:l("nav.nu__main-nav > ul > li.has-children"),categories:l("#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:last-child > div"),backtocats:l("#howdoi.neumenu-wrapper > .neumenu-wrapper-inner > div:first-child > .removefilter"),_init:function(){l("div.wrapper, footer, div#nu__global-footer").on("click",Finance.Nav._didClickOutsideNav),Finance.Nav.parentlinks.on("click",Finance.Nav._didClickDropdown),Finance.Nav.categories.on("click",Finance.Nav._didClickCategory),Finance.Nav.backtocats.on("click",Finance.Nav._didClickBackToCats)},_didClickBackToCats:function(){Finance.Nav.categories.removeClass("theFilter"),Finance.Nav.categories.parents(".neumenu-wrapper-inner").removeClass("isFiltered"),l("#nu__main-nav-desktop > ul > li:first-child > a").focus()},_didClickCategory:function(e){l(this).parents(".neumenu-wrapper-inner").addClass("isFiltered"),l(this).addClass("theFilter"),l("#howdoi > div > div:first-child > a").attr("tabindex","0"),l(this).find("a").attr("tabindex","0")},_didClickOutsideNav:function(e){0===l("div#nu__globalheader, div#header").has(e.target).length&&(l("li.has-children").find(".neumenu-wrapper").hide(),l("li.has-children").find(".isFiltered").removeClass("isFiltered"),l("li.has-children").find(".theFilter").removeClass("theFilter"),Finance.Nav.dropdowns.removeClass("neu__showme"),l("#neu__navicon").removeAttr("checked"),l("#nu__mobile a.active").removeClass("active"),l("#nu__mobile .show").hide(),l("#nu__mobile .show").removeClass("show"),l("html, body").removeClass("neu__noscroll"))}},Finance.Nav._init(),Finance.MobileNav={navicon:l("#neu__navicon-label"),nav:l("#nu__mobile"),_init:function(){Finance.MobileNav.navicon.on("click",Finance.MobileNav._didClickNavicon)},_didClickNavicon:function(e){l("body").toggleClass("neu__noscroll")}},Finance.MobileNav._init(),l(".js-mobile-nav").click(function(e){e.preventDefault();var n=l(this);n.next().hasClass("show")?(n.next().removeClass("show"),n.removeClass("active"),n.next().slideUp(350)):(n.parent().parent().find("li .inner").removeClass("show"),n.hasClass("parent")?n.parents("#nu__mobile > nav ul").find(".toggle").removeClass("active"):n.hasClass("child")?n.parents("#nu__mobile > nav ul").find(".toggle.child").removeClass("active"):n.parents("#nu__mobile > nav ul").find(".toggle.child-child").removeClass("active"),n.parent().parent().find("li .inner").slideUp(350),n.next().toggleClass("show"),n.addClass("active"),n.next().slideToggle(350))}),Finance.JumpNav={_init:function(){l(window).on("hashchange",Finance.JumpNav._doHashHandler)},_doHashHandler:function(e){var n=window.location.hash.substring(1);if(n){var i=l("div#nu__globalheader").height()+l("header").height(),a=l("#"+n).offset().top;l(window).scrollTop(a-i)}}},Finance.JumpNav._init(),Finance.faqs={triggers:l(".js__collapsible_list > li > a"),questions:l(".js__collapsible_list > li"),answers:l(".js__collapsible_list > li > div"),_init:function(){l(window).on("load",Finance.faqs._loadHandler),Finance.faqs.triggers.on("click",Finance.faqs._clickHandler)},_loadHandler:function(e){Finance.faqs.answers.slideUp(0),Finance.JumpNav._doHashHandler()},_clickHandler:function(e){var n="js__collapsible_opened",i=l(this).siblings("div"),a=Finance.faqs.answers.not(i);l(a).removeClass(n),l(a).slideUp(200),Finance.faqs.questions.removeClass("js__collapsible_triggered"),l(i).hasClass(n)?(l(this).parent("li").removeClass("js__collapsible_triggered"),l(i).removeClass(n),l(i).slideUp(200)):(l(this).parent("li").addClass("js__collapsible_triggered"),l(i).addClass(n),l(i).slideDown(200))}},Finance.faqs._init()})}(jQuery,this);