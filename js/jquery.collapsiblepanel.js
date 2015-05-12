(function ($) {
    $.fn.extend({
        collapsiblePanel: function () {
            $(this).each(function () {
                var indicator = $(this).find('.ui-expander').first();
                var header = $(this).find('.ui-widget-header').first();
                var content = $(this).find('.ui-widget-content').first();
                if (content.is(':visible')) {
                    header.removeClass('hvr-bubble-bottom').addClass('hvr-bubble-top');
                } else {
                    header.removeClass('hvr-bubble-top').addClass('hvr-bubble-bottom');
                }

                header.click(function () {
                    content.slideToggle(500, function () {
                        console.log(content.is(':visible'));
                        if (content.is(':visible')) {
                            header.removeClass('hvr-bubble-bottom').addClass('hvr-bubble-top');
                        } else {
                            header.removeClass('hvr-bubble-top').addClass('hvr-bubble-bottom');
                        }
                    });
                });
            });
        }
    });
})(jQuery);
