;(function($) {

    $.fn.unveil = function(threshold, callback) {

        var $w = $(window),
            th = threshold || 0,
            elements = this,
            loaded;

        // threshold as perset of window height
        if((/^[0-9]+(vh|\%)$/i).test(th) == true) {
            th = parseInt(th);
            th = $(window).height() * (th/100);
        }

        this.one("unveil", function() {
            if (typeof callback === "function") callback.call(this);
        });

        function unveil() {
            var inview = elements.filter(function() {
                var $e = $(this);
                //if ($e.is(":hidden")) return;

                var wt = $w.scrollTop(),
                    wb = wt + $w.height(),
                    et = $e.offset().top,
                    eh = $e.outerHeight(),
                    eb = et + eh;
                return eb >= wt - th && et <= wb + th;
            });

            loaded = inview.trigger("unveil");
            elements = elements.not(loaded);
        }

        $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);
        //$('body').on('scroll.unveil', unveil);

        unveil();

        return this;

    };

})(window.jQuery || window.Zepto);