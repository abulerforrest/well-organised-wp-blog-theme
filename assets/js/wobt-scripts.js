document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
        $el.classList.add('is-active');
    }

    function closeModal($el) {
        $el.classList.remove('is-active');
    }

    function closeAllModals() {
        (document.querySelectorAll('.modal') || []).forEach(($modal) => {
            closeModal($modal);
        });
    }

    // Add a click event on buttons to open a specific modal
    (document.querySelectorAll('.wobt-thumbnail-launch') || []).forEach(($trigger) => {
        const modal = $trigger.dataset.target;
        const $target = document.getElementById(modal);

        $trigger.addEventListener('click', () => {
            openModal($target);
        });
    });

    // Add a click event on various child elements to close the parent modal
    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
        const $target = $close.closest('.modal');

        $close.addEventListener('click', () => {
            closeModal($target);
        });
    });

    // Add a keyboard event to close all modals
    document.addEventListener('keydown', (event) => {
        const e = event || window.event;

        if (e.keyCode === 27) { // Escape key
            closeAllModals();
        }
    });
});

(function($) {
    $(document).ready(function(){
        $("#wobt-search-input-form-wrapper").hide();

        $(".wobt-menu-search-button-label").click(() => {
            toggleDisplaySearch();
        });

        function toggleDisplaySearch() {
            var top_section = $(".wobt-top-section");
            if ($("#wobt-search-input-form-wrapper").css("display") === "none") {
                $("#wobt-search-input-form-wrapper").show();
                $(".wobt-search-input").focus();
                top_section.animate({height: 120},200);

            } else {
                $("#wobt-search-input-form-wrapper").hide();
                top_section.animate({height: 40},200);

                $(".wobt-top-section").animate({height: 40},200);
            }
        }

        $("#wobt-search-form").on("submit", function(e){
            e.preventDefault();
            const searchVal = $(".wobt-search-input").val();
            if (searchVal !== '') {
                this.submit();
            } else {
                $(".wobt-search-tooltip").attr('data-tooltip', 'Vänligen ange något att söka på.');
                $(".wobt-search-tooltip").keydown(() => {
                    $(".wobt-search-tooltip").removeAttr('data-tooltip');
                })
            }

        });

        $(document).on('keydown', function(event) {
            if (event.key === "Escape") {
                var top_section = $(".wobt-top-section");
                top_section.animate({height: 40},200);
                $('#wobt-search-input-form-wrapper').hide();
                const el = $('.wobt-dropdown-menu');
                $('.wobt-dropdown-menu').addClass('wobt-menu-hide');
                $('.wobt-dropdown-menu').removeClass('wobt-menu-show');
                $('.wobt-dropdown-menu').on('webkitAnimationEnd oanimationend msAnimationEnd animationend',
                    function() {
                        $('.wobt-dropdown-menu').css("visibility", "hidden");
                    });
            }
        });

        $(".wobt-menu-dropdown-button-label").click(() => {
            const el = $('.wobt-dropdown-menu');
            if (el.hasClass("wobt-menu-show")) {
                $('.wobt-dropdown-menu').addClass('wobt-menu-hide');
                $('.wobt-dropdown-menu').removeClass('wobt-menu-show');
                $('.wobt-dropdown-menu').on('webkitAnimationEnd oanimationend msAnimationEnd animationend',
                    function() {
                        $('.wobt-dropdown-menu').css("visibility", "hidden");
                    });
            } else {
                $('.wobt-dropdown-menu').css("visibility", "visible");
                $('.wobt-dropdown-menu').addClass('wobt-menu-show');
                $('.wobt-dropdown-menu').removeClass('wobt-menu-hide');
                $('.wobt-dropdown-menu').on('webkitAnimationEnd oanimationend msAnimationEnd animationend',
                    function() {
                        $('.wobt-dropdown-menu').css("visibility", "visible");
                    });
            }
        });

        $(document).click(function(e) {
            var wrapper = $(".wobt-dropdown-menu");
            var wrapper2 = $("#wobt-search-input-form-wrapper");

            if (!wrapper2.is(e.target) && !wrapper2.has(e.target).length) {
                if(e.target.id !== 'wobt-menu-search-button-label' && e.target.id !== 'wobt-menu-search-icon') {
                    var top_section = $(".wobt-top-section");
                    wrapper2.hide();
                    top_section.animate({
                        height: 40,
                    }, 200)
                        .stop(true).css({height: 40});
                }
            }

            if (!wrapper.is(e.target) && !wrapper.has(e.target).length) {
                if(e.target.id !== 'wobt-menu-dropdown-button-label' && e.target.id !== 'wobt-menu-dropdown-icon') {
                    $('.wobt-dropdown-menu').addClass('wobt-menu-hide');
                    $('.wobt-dropdown-menu').removeClass('wobt-menu-show');
                    $('.wobt-dropdown-menu').on('webkitAnimationEnd oanimationend msAnimationEnd animationend',
                        function() {
                            $('.wobt-dropdown-menu').css("visibility", "hidden");
                        });
                }
            }
        });

        var menu = $(".wobt-menu-dropdown-wrapper"),
            pos = menu.offset();
        $(window).scroll(function() {
            if ($(this).scrollTop() > (pos.top) && $(menu.css('position') == 'static')) {
                $(menu).addClass('wobt-menu-fixed');
            } else {
                if($(menu).hasClass("wobt-menu-fixed")) {
                    $(menu).removeClass('wobt-menu-fixed');
                }
            }
        });
    });
})(jQuery);