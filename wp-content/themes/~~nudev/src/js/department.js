// the main js file (scripts.js, which is tagged 'theme') is a dependency of this and all conditionally loaded script files,
// var Finance = {} is available and must not be overwritten due to scripts in the main js file
(function ($, root, undefined) {
    $(function () {

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


        // Magnific Popup
        $(".js__bio").magnificPopup({
            // type: "iframe"
            type: "ajax",
            closeMarkup: '<button title="%title%" aria-label="Close (Esc)" type="button" class="mfp-close">&#215;</button>            ',
            closeOnContentClick: false,
            closeOnBgClick: true,
            enableEscapeKey: false,
            verticalFit: true,
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });

        
    });
})(jQuery, this);