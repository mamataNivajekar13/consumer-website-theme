const input = document.getElementById('locationInput');
const hiddenDiv = document.getElementById('city-list-wrapper');
const icnameValue = input.getAttribute('data-icname');
const autocomplete = new google.maps.places.Autocomplete(input, {
    fields: ['name', 'geometry'],
    componentRestrictions: { country: 'IN' },
    //offset: 3
});

autocomplete.addListener('place_changed', function () {
    const place = autocomplete.getPlace();
    if (!place || !place.geometry || place.geometry.viewport.isEmpty()) {
        console.log("No results found");
        var pacContainer = document.querySelector('.pac-container');
        var newDiv = document.createElement('div');
        newDiv.className = 'pac-item';
        newDiv.innerHTML = '<span>No results found</span>';
        pacContainer.appendChild(newDiv);
        pacContainer.style.display = 'block';
    } else {
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var city_slug = place.name.toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "");
        var url = window.location.href + city_slug + '/?lat=' + latitude + '&lng=' + longitude;
        window.location.href = url;
        tmClickEvent('City search', 'NH-India', icnameValue, place.name);
        console.log("Results found");
    }
});

function showDiv() {
    hiddenDiv.style.display = 'block';
}

function hideDiv() {
    hiddenDiv.style.display = 'none';
}

function handleInput() {
    if (input.value.trim() === '') {
        showDiv();
    } else {
        hideDiv();
    }
}

input.addEventListener('click', handleInput);
input.addEventListener('input', handleInput);

document.addEventListener('click', function (event) {
    const isClickInsideInput = input.contains(event.target);
    if (!isClickInsideInput) {
        hideDiv();
    }
});

$(document).ready(function () {
    $("#locationInput").val("");
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

    $('#insurer-select').select2({
        language: {
            noResults: function (params) {
                var term = $('#insurer-select').data('select2').$dropdown.find('.select2-search__field').val();
                return 'No results match "' + term + '"';
            }
        }
    });
    $('#insurer-select').on('change', function () {
        var dataAttributeValue = $(this).find(':selected').data('url');
        var insurername = $(this).find(':selected').data('insurername');
        var icname = $(this).find(':selected').data('icname');
        var insurerlabel = $(this).find(':selected').attr('label');

        if (dataAttributeValue) {
            window.location.href = dataAttributeValue + "network-hospitals/";
        }

        tmClickEvent('Insurer search', 'NH-India', icname, insurerlabel);
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

