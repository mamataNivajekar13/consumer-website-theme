$(document).ready(function () {
    $('#cg-insurer-select').select2({
        language: {
            noResults: function (params) {
                var term = $('#cg-insurer-select').data('select2').$dropdown.find('.select2-search__field').val();
                return 'No results match "' + term + '"';
            }
        }
    });

    $('#cg-insurer-select').on('change', function () {
        var dataAttributeValue = $(this).find(':selected').data('url');
        var insurername = $(this).find(':selected').data('insurername');
        var icname = $(this).find(':selected').data('icname');
        var insurerlabel = $(this).find(':selected').attr('label');

        if (dataAttributeValue) {
            window.location.href = dataAttributeValue + "cashless-garages/";
        }

        tmClickEvent('Insurer search', 'CG-India', icname, insurerlabel);
    });

    const initialItemCount = 10;

    var $items = $('#tmAccordion-states .tm-accordion-item').not('.d-none');
    $items.slice(initialItemCount).hide();

    $('.view-more-states').on('click', function () {
        $items.show();
        $(this).hide();
        $('.view-less-states').show();
        $(this).removeClass('active');
        $('.view-less-states').addClass('active');
    });

    $('.view-less-states').on('click', function () {
        var $itemsModified = $('#tmAccordion-states .tm-accordion-item').not('.d-none');
        $itemsModified.slice(initialItemCount).hide();
        $(this).hide();
        $('.view-more-states').show();
        $(this).removeClass('active');
        $('.view-more-states').addClass('active');
        $('html, body').animate({
            scrollTop: $('#states-list').offset().top - 80
        }, 500);
    });

    if ($(window).width() < 782) {
        const popularCount = 6;
        $('.view-more-popular-cities').show();
        const $pitems = $('.popular-cities-list .popular-city');
        $pitems.slice(popularCount).addClass('d-none');

        $('.view-more-popular-cities').on('click', function () {
            $pitems.removeClass('d-none');
            $(this).hide();
            $('.view-less-popular-cities').show();
        });

        $('.view-less-popular-cities').on('click', function () {
            $pitems.slice(popularCount).addClass('d-none');
            $(this).hide();
            $('.view-more-popular-cities').show();

            $('html, body').animate({
                scrollTop: $('#popular-cities').offset().top
            }, 500);
        });
    }
});