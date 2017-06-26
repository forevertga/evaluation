/**
 * Increase the footer margin (if needed) so the footer rests at the bottom of the page.
 */
(function ($) {
    var $window = $(window),
        $body = $('body'),
        $footer = $('.site-footer'),
        initialMargin = parseInt($footer.css('margin-top'));

    setFooterMargin();
    $window.on('resize load', setFooterMargin);

    function setFooterMargin() {
        var windowHeight = $window.height();

        // Reset footer margin to default;
        $footer.css('margin-top', initialMargin);

        var bodyHeight = $body.height();

        if (windowHeight > bodyHeight) {
            var difference = windowHeight - bodyHeight;
            $footer.css('margin-top', initialMargin + difference)
        }
    }
})(jQuery);