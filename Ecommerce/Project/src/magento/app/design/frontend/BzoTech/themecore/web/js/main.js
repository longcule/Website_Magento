define([
        "jquery",
        "unveil",
        "domReady!"
    ],
    function ($) {
        /**
         * Check Sidebar has content
         */

        var sidebarElement = $(".sidebar").children().length;
        console.log(sidebarElement);
        if (sidebarElement) {
            $(".page-products").addClass('has-sidebar');
        } else {
            $(".page-products").addClass('no-sidebar');
        }


        /**
         * Lazy load image
         */

        if ($('.enable-ladyloading').length) {
            function _runLazyLoad() {
                $("img.lazyload").unveil(0, function () {
                    $(this).load(function () {
                        this.classList.remove("lazyload");
                    });
                });
            }

            setTimeout(function () {
                _runLazyLoad();
            }, 1000);

            $(document).on("afterAjaxLazyLoad", function () {
                _runLazyLoad();
            });
        }

        /**
         * Back to top
         */
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 500) {
                    $('.back2top').addClass('active');
                } else {
                    $('.back2top').removeClass('active');
                }
            });
            $('.back2top').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

        });

        /**
         * Layered navigation
         */

        $(document).on('click', '.btn-open-close', function () {
            if ($(this).hasClass('active')) {
                $(this).closest('.filter-options-item').removeClass('active');
                $(this).removeClass('active');
                return;
            } else {
                $('.filter-options-item').removeClass('active');
                $('.btn-open-close').removeClass('active');
                $(this).closest('.filter-options-item').addClass('active');
                $(this).addClass('active');
            }

        });
    });