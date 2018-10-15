(function ($, root, undefined) {

	$(function () {

		if ($(window).width() < 1260) {
   		$('.download').removeClass('hvr-shutter-out-horizontal');
		}
		else {
		   $('.download').addClass('hvr-shutter-out-horizontal');
		}

		//$('.download').removeClass('hvr-shutter-out-horizontal');





		// if we are on the staff page, allow for some links to open full bio details in a lightbox
		if($("#staff").length){

			$(".js__bio").magnificPopup({
	        // type: "iframe"
					type: "ajax"
	        ,closeOnContentClick: false
	        ,closeOnBgClick: false
	        ,enableEscapeKey: false
	        ,verticalFit: true
					,removalDelay: 300
					,mainClass: 'mfp-fade'
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

		targetOffset = ($(window).height() / 2);  // half the height of the browser window, needs to be re-calculated on page re-size!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //console.log(targetOffset);

		//console.log("HEADER: "+$("header").height());

		function getScrollSections(){
			$(".nu__section-break").each(function(i){
				if(i == 0){
					pageSections[$(this).attr("id")] = 0;
				}else{
					pageSections[$(this).attr("id")] = parseInt(($(this).offset().top) + $("header").height() - targetOffset);
				}
	    });
		}

		getScrollSections();
		//console.log(pageSections);


    // this is the function that will check if the element is on the screen or not
    function isScrolledIntoView(elem){
      var docViewTop = $(window).scrollTop();
      var docViewBottom = docViewTop + $(window).height();
      var elemTop = $(elem).offset().top;
      var elemBottom = elemTop + $(elem).height();
      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).scroll(function(){
			$(".nu__col-left ul:not(.noautoscroll) li a").removeClass("active");
			var i = 0;
			for(var p in pageSections){
        result = isScrolledIntoView($("#section-"+i));

				if(result){
					//console.log("SECTION-"+i+": "+result);
					$(".nu__col-left ul li a").removeClass("active");
					$(".nu__col-left ul li a[data-id="+i+"]").addClass("active");
					break;
				}
				i++;
      }
    });

		// when a user clicks on one of the sub-nav options to scroll the page
		$(".nu__col-left ul:not(.noautoscroll)").on("click", "a",function(e){
			console.log("click");
			e.preventDefault();
			var t = $(this);
			$(".nu__col-left ul li a").removeClass("active");
			$("html,body").animate({
          scrollTop: pageSections["section-"+t.attr("data-id")]
      },500,function(){
				t.addClass("active");
			});
		});



		/*Remove the lines below once you are done testing*/
var wi = $(window).width();
$("p.testp").text('Screen width is currently: ' + wi + 'px.');

$(window).resize(function() {



	targetOffset = ($(window).height() / 2);

	getScrollSections();

	if ($(window).width() < 1260) {
		$('.download').removeClass('hvr-shutter-out-horizontal');
	}
	else {
		 $('.download').addClass('hvr-shutter-out-horizontal');
	}



    /*Remove the lines below once you are done testing*/
    var wi = $(window).width();

    if (wi <= 576){
        $("p.testp").text('Screen width is less than or equal to 576px. Width is currently: ' + wi + 'px.');
        }
    else if (wi <= 680){
                                    $("p.testp").text('Screen width is between 577px and 680px. Width is currently: ' + wi + 'px.');
                                    }
    else if (wi <= 1024){
                                    $("p.testp").text('Screen width is between 681px and 1024px. Width is currently: ' + wi + 'px.');
                                    }
    else if (wi <= 1500){
                                    $("p.testp").text('Screen width is between 1025px and 1499px. Width is currently: ' + wi + 'px.');
                                    }
    else {
                                    $("p.testp").text('Screen width is greater than 1500px. Width is currently: ' + wi + 'px.');
                                    }
});









	});

})(jQuery, this);
