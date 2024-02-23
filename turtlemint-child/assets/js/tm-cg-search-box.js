$(document).ready(function () {
    $("#cgcityinput").val("");
    const hiddenDiv = $('#city-list-wrapper');
    const input = $('#cgcityinput');
    const cgPopCityList = $('.cg-city-list');


    $('#cgcityinput').on('keyup', function () {
        if ($(this).val().length > 2) {
            searchCgCities($(this).val());
            cgPopCityList.show();
        } else {
            $('.cg-city-list').html("");
        }
    });

    function showDiv() {
        hiddenDiv.show();
    }

    function hideDiv() {
        hiddenDiv.hide();
    }

    function hideCgPopCityList() {
        cgPopCityList.hide();
    }

    function handleInput() {
        if (input.val().trim() === '') {
            showDiv();
            cgPopCityList.hide();
        } else {
            hideDiv();
            cgPopCityList.show();
        }
    }

    input.on('click input', handleInput);

    $(document).on('click', function (event) {
        const isClickInsideInput = input.is(event.target) || input.has(event.target).length > 0;
        if (!isClickInsideInput) {
            hiddenDiv.hide();
            cgPopCityList.hide();
        }
    });
});

function searchCgCities(city) {
    let ajaxUrl = '/wp-admin/admin-ajax.php';
    if (window.location.origin == 'http://localhost') {
        ajaxUrl = '//localhost/consumer-website-wordpress/wp-admin/admin-ajax.php';
    }
    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        dataType: 'json',
        data: {
            action: 'search_cg_city',
            keyword: city,
        },
        complete: function (res) {
            $('.cg-city-list').html(res.responseJSON.html);
        },
        error: function (err) {
            console.log(err);
        }
    })
}

function selectCity(city) {
    var icnameValue = $("#cgcityinput").attr("data-icname");
    $("#cgcityinput").val("");
    var city_slug = city.toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "");
    var current_url = window.location.href;
    var new_url = (current_url.indexOf("cashless-garages") !== -1) ? current_url : current_url + "cashless-garages/";
    var url = new_url + city_slug;
    window.location.href = url;
    tmClickEvent('City search', 'CG-India', icnameValue, city_slug);
}